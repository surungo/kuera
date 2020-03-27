<?php
class HZip {
	/**
	 * Add files and sub-directories in a folder to zip file.
	 *
	 * @param string $folder        	
	 * @param ZipArchive $zipFile        	
	 * @param int $exclusiveLength
	 *        	Number of text to be exclusived from the file path.
	 */
	private static function folderToZip($folder, &$zipFile, $exclusiveLength) {
		$handle = opendir ( $folder );
		while ( false !== $f = readdir ( $handle ) ) {
			if ($f != '.' && $f != '..') {
				$filePath = "$folder/$f";
				// Remove prefix from file path before add to zip.
				$localPath = substr ( $filePath, $exclusiveLength );
				if (is_file ( $filePath )) {
					$zipFile->addFile ( $filePath, $localPath );
				} elseif (is_dir ( $filePath )) {
					// Add sub-directory.
					$zipFile->addEmptyDir ( $localPath );
					self::folderToZip ( $filePath, $zipFile, $exclusiveLength );
				}
			}
		}
		closedir ( $handle );
	}
	
	/**
	 * Zip a folder (include itself).
	 *
	 * Usage:
	 * HZip::zipDir('/path/to/sourceDir', '/path/to/out.zip');
	 *
	 * @param string $sourcePath
	 *        	Path of directory to be zip.
	 * @param string $outZipPath
	 *        	Path of output zip file.
	 */
	public static function zipDir($sourcePath, $outZipPath) {
		$pathInfo = pathInfo ( $sourcePath );
		$parentPath = $pathInfo ['dirname'];
		$dirName = $pathInfo ['basename'];
		
		$z = new ZipArchive ();
		$z->open ( $outZipPath, ZIPARCHIVE::CREATE );
		$z->addEmptyDir ( $dirName );
		self::folderToZip ( $sourcePath, $z, strlen ( "$parentPath/" ) );
		$z->close ();
	}
	public static function unZip($sourcePath, $outZipPath) {
		$zip = new ZipArchive ();
		if (file_exists ( $sourcePath )) {
			echo "O arquivo $sourcePath existe<br>";
			if ($zip->open ( $sourcePath ) === TRUE) {
				$zip->extractTo ( $outZipPath );
				$zip->close ();
				echo "Unzip $sourcePath ok<br>";
			} else {
				echo "Unzip $sourcePath failed<br>";
			}
		} else {
			echo "O arquivo $sourcePath n�o existe<br>";
		}
	}
}
?>