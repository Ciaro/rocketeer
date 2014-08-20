<?php
namespace Rocketeer\Abstracts;

class AbstractPackageManager extends AbstractBinary
{
	/**
	 * The name of the manifest file to look for
	 *
	 * @type string
	 */
	protected $manifest;

	/**
	 * Check if the manifest file exists, locally or on server
	 *
	 * @return bool
	 */
	public function hasManifest()
	{
		$server = $this->paths->getFolder('current/'.$this->manifest);
		$server = $this->bash->fileExists($server);

		$local = $this->app['path.base'].DS.$this->manifest;
		$local = $this->files->exists($local);

		return $local || $server;
	}

	/**
	 * Get the contents of the manifest file
	 *
	 * @return string|null
	 * @throws \Illuminate\Filesystem\FileNotFoundException
	 */
	public function getManifestContents()
	{
		$manifest = $this->app['path.base'].DS.$this->manifest;
		if ($this->files->exists($manifest)) {
			return $this->files->get($manifest);
		}

		return null;
	}

	/**
	 * @return string
	 */
	public function getManifest()
	{
		return $this->manifest;
	}
}
