<?php

/**
 * WEBSITE INFO
 * Author: Dzu
 * Mail: dzu6996@gmail.com
 **/
class Info
{
	private $title = "Hệ Thống Trắc Nghiệm Online";
	private $admin_title = "Admin Cpanel - Trắc Nghiệm Online";
	private $copyright = "Copyright © 2016 By Dzu";
	private $version = "2.1.0";
	private $contributes = "Nhóm phát triển:<br />Nông Văn Du (dzu6996@gmail.com)<br />Trịnh Văn Dương<br />Trần Văn Huy<br />Vương Văn Huy<br />Hoàng Phương Nam";
	private $release = "Release 12/01/2018";

	public function getTitle()
	{
		return $this->title;
	}
	public function getAdminTitle()
	{
		return $this->admin_title;
	}
	public function getCopyright()
	{
		return $this->copyright;
	}
	public function getVersion()
	{
		return $this->version;
	}
	public function getContributes()
	{
		return $this->contributes;
	}
	public function getRelease()
	{
		return $this->release;
	}
}
?>