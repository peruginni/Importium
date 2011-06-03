<?php

namespace Om\Multimedia;

use Om\Core\IBaseBusiness;
use Om\Utilities\IPaginator;

/**
 * Interface of business logic for images
 *
 * @author      Ondrej Macoszek <ondra.macoszek@gmail.com>
 * @copyright   Copyright (c) 2010 Ondrej Macoszek
 */
interface IImageBusiness extends IBaseBusiness
{
	
	/**#@+ thubnail types */
	const THUMBNAIL_SMALL = 1;
	const THUMBNAIL_MEDIUM = 2;
	const THUMBNAIL_LARGE = 3;
	/**#@-*/

	/**#@+ scale modes */
	const ASPECT_FIT = 1;
	const ASPECT_CROP = 2;
	/**#@-*/

	public function getThumbnailSmallDimension();
	public function setThumbnailSmallDimension($width, $height);



	public function getThumbnailMediumDimension();
	public function setThumbnailMediumDimension($width, $height);



	public function getThumbnailLargeDimension();
	public function setThumbnailLargeDimension($width, $height);



	public function getMaxDimension();
	public function setMaxDimension($width, $height);



	public function getQuality();
	public function setQuality($quality);



	public function crop(Image $image, $x1, $y1, $x2, $y2);



	public function scale(Image $image, $mode, $width, $height);



	public function makeThumbnail(Image $image, $mode);



	public function findImagesByAlbum(Album $folder, IPaginator $paginator = null);

}

