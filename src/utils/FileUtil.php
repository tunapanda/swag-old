<?php
	/**
	 * File utils.
	 */
	class FileUtil {

		/**
		 * Find all files with matchong extension.
		 */
		public static function findFilesWithExt($directory, $ext) {
			$dir=new RecursiveDirectoryIterator($directory);
			$iterator=new RecursiveIteratorIterator($dir);

			$files=array();

			foreach($iterator as $it) {
				$pathext=pathinfo($it,PATHINFO_EXTENSION);

				if ($pathext==$ext) {
					$fn=str_replace($directory,"",$it);

					if (substr($fn,0,1)=="/")
						$fn=substr($fn,1);

					$files[]=$fn;
				}
			}

			return $files;
		}
	}