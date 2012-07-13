<?php

namespace Fuel\Migrations;

class Memopad
{
	function up()
	{
		\DBUtil::create_table(
			'users',
			array(
				'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true, 'unsigned' => true, 'null' => false),
				'username' => array('type' => 'varchar', 'constraint' => 32, 'null' => false),
				'password' => array('type' => 'varchar', 'constraint' => 255, 'null' => false),
				'email' => array('type' => 'varchar', 'constraint' => 255, 'null' => false),
				'last_login' => array('type' => 'datetime', 'null' => true),
				'login_hash' => array('type' => 'varchar', 'constraint' => 255, 'null' => true),
				'updated_at' => array('type' => 'datetime', 'null' => false),
				'created_at' => array('type' => 'datetime', 'null' => false),
			),
			array('id'),
			true,
			'InnoDB',
			'utf8'
		);
		\DBUtil::create_index(
			'users',
			array('username'),
			'u_users_username',
			'UNIQUE'
		);

		\DBUtil::create_table(
			'memos',
			array(
				'id' => array('type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true, 'null' => false),
				'user_id' => array('type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => false),
				'text' => array('type' => 'text', 'null' => false),
				'updated_at' => array('type' => 'datetime',	'null' => false),
				'created_at' => array('type' => 'datetime', 'null' => false),
			),
			array('id'),
			true,
			'InnoDB',
			'utf8'
		);
		\DBUtil::create_index(
			'memos',
			array('user_id'),
			'f_memos_user_id'
		);

		\DBUtil::create_table(
			'tags',
			array(
				'tag' => array('type' => 'varchar', 'constraint' => 255, 'null' => false),
				'user_id' => array('type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => false),
				'memo_id' => array('type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => false),
				'updated_at' => array('type' => 'datetime',	'null' => false),
				'created_at' => array('type' => 'datetime', 'null' => false),
			),
			array(),
			true,
			'InnoDB',
			'utf8'
		);
		\DBUtil::create_index(
			'tags',
			array('tag'),
			'i_tags_tag'
		);
		\DBUtil::create_index(
			'tags',
			array('user_id'),
			'f_tags_user_id'
		);
		\DBUtil::create_index(
			'tags',
			array('memo_id'),
			'f_tags_memo_id'
		);

	}

	function down()
	{
		\DBUtil::drop_table('tags');
		\DBUtil::drop_table('memos');
		\DBUtil::drop_table('users');
	}
}
