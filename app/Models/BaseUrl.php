<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class BaseUrl extends Model {
	
	// profile image
	public static function getProfileImageUrl()
	{
		return 'global/uploads/images/userprofile';
	}

	// blog image
	public static function getBlogImageUrl()
	{
		return 'global/uploads/images/blogimages';
	}

	// page template thumbnail
	public static function getPageTemplateThumbnailUrl()
	{
		return "global/img/page_templates/thumbnails/";
	}

	// page template image
	public static function getPageTemplateUrl()
	{
		return "global/img/page_templates";
	}

	// 
	public static function getPageThumbnailUrl()
	{
		return "global/uploads/images/pages/thumbnails";
	}

	// blog listing thumbnails
	public static function getRecentPostsThumbnailUrl()
	{
		return 'global/uploads/images/blogimages/thumbnails/recent_posts';
	}

	// blog recent posts thumbnails
	public static function getBlogListingThumbnailUrl()
	{
		return 'global/uploads/images/blogimages/thumbnails/blog_listing';
	}

        // User Profile Image thumbnails
	public static function getUserProfileThumbnailUrl()
	{
		return 'global/uploads/images/userprofile/thumbnails';
	}

}
