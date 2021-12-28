<?php

/**
 * This file is part of CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace CodeIgniter\Database\Builder;

use CodeIgniter\Database\BaseBuilder;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Database\SQLSRV\Builder as SQLSRVBuilder;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\Mock\MockConnection;

/**
 * @internal
 */
final class FromTest extends CIUnitTestCase
{
    protected $db;

    protected function setUp(): void
    {
        parent::setUp();

        $this->db = new MockConnection([]);
    }

    public function testSimpleFrom()
    {
        $builder = new BaseBuilder('user', $this->db);

        $builder->from('jobs');

        $expectedSQL = 'SELECT * FROM "user", "jobs"';

        $this->assertSame($expectedSQL, str_replace("\n", ' ', $builder->getCompiledSelect()));
    }

    public function testFromThatOverwrites()
    {
        $builder = new BaseBuilder('user', $this->db);

        $builder->from('jobs', true);

        $expectedSQL = 'SELECT * FROM "jobs"';

        $this->assertSame($expectedSQL, str_replace("\n", ' ', $builder->getCompiledSelect()));
    }

    public function testFromWithMultipleTables()
    {
        $builder = new BaseBuilder('user', $this->db);

        $builder->from(['jobs', 'roles']);

        $expectedSQL = 'SELECT * FROM "user", "jobs", "roles"';

        $this->assertSame($expectedSQL, str_replace("\n", ' ', $builder->getCompiledSelect()));
    }

    public function testFromWithMultipleTablesAsString()
    {
        $builder = new BaseBuilder('user', $this->db);

        $builder->from(['jobs, roles']);

        $expectedSQL = 'SELECT * FROM "user", "jobs", "roles"';

        $this->assertSame($expectedSQL, str_replace("\n", ' ', $builder->getCompiledSelect()));
    }

    public function testFromReset()
    {
        $builder = new BaseBuilder('user', $this->db);

        $builder->from(['jobs', 'roles']);

        $expectedSQL = 'SELECT * FROM "user", "jobs", "roles"';

        $this->assertSame($expectedSQL, str_replace("\n", ' ', $builder->getCompiledSelect()));

        $expectedSQL = 'SELECT * FROM "user"';

        $this->assertSame($expectedSQL, str_replace("\n", ' ', $builder->getCompiledSelect()));

        $expectedSQL = 'SELECT *';

        $builder->from(null, true);

        $this->assertSame($expectedSQL, str_replace("\n", ' ', $builder->getCompiledSelect()));

        $expectedSQL = 'SELECT * FROM "jobs"';

        $builder->from('jobs');

        $this->assertSame($expectedSQL, str_replace("\n", ' ', $builder->getCompiledSelect()));
    }

    public function testFromSubquery()
    {
        // Subquery as table
        $expectedSQL = 'SELECT * FROM (SELECT * FROM "users")';
        $subquery    = new BaseBuilder('users', $this->db);
        $builder     = new BaseBuilder($subquery, $this->db);

        $this->assertSame($expectedSQL, str_replace("\n", ' ', $builder->getCompiledSelect()));

        // Subquery with alias
        $expectedSQL = 'SELECT * FROM (SELECT "id", "name" FROM "users") AS users_1';

        $subquery = (new BaseBuilder('users', $this->db))->select('id, name');
        $builder  = new BaseBuilder([$subquery, 'users_1'], $this->db);

        $this->assertSame($expectedSQL, str_replace("\n", ' ', $builder->getCompiledSelect()));
    }

    public function testFromSubqueryExceptions()
    {
        $this->expectException(DatabaseException::class);
        $this->expectExceptionMessage('Table name must be string or instance of the BaseBuilder');
        $subquery = new BaseBuilder('users', $this->db);
        $builder  = new BaseBuilder([$subquery], $this->db);

        $this->expectException(DatabaseException::class);
        $this->expectExceptionMessage('Subquery must have an alias');
        $subquery = new BaseBuilder('users', $this->db);
        $builder  = new BaseBuilder('jobs', $this->db);
        $builder->from($subquery);
    }

    public function testFromWithMultipleTablesAsStringWithSQLSRV()
    {
        $this->db = new MockConnection(['DBDriver' => 'SQLSRV', 'database' => 'test', 'schema' => 'dbo']);

        $builder = new SQLSRVBuilder('user', $this->db);

        $builder->from(['jobs, roles']);

        $expectedSQL = 'SELECT * FROM "test"."dbo"."user", "test"."dbo"."jobs", "test"."dbo"."roles"';

        $this->assertSame($expectedSQL, str_replace("\n", ' ', $builder->getCompiledSelect()));
    }

    public function testFromSubqueryWithSQLSRV()
    {
        $this->db = new MockConnection(['DBDriver' => 'SQLSRV', 'database' => 'test', 'schema' => 'dbo']);

        $subquery = new SQLSRVBuilder('users', $this->db);

        $builder = new SQLSRVBuilder('jobs', $this->db);

        $builder->from([$subquery, 'users_1']);

        $expectedSQL = 'SELECT * FROM "test"."dbo"."jobs", (SELECT * FROM "test"."dbo"."users") AS users_1';

        $this->assertSame($expectedSQL, str_replace("\n", ' ', $builder->getCompiledSelect()));
    }
}
