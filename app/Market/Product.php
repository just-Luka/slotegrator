<?php

declare(strict_types=1);

namespace App\Market;

/**
 * Represents a single product record stored in DB.
 */
final readonly class Product
{

    /**
     * @var string
     */
    private string $imageFileName;

    /**
     * @param FileStorageRepository $storage
     */
    public function __construct(
        private FileStorageRepository $storage
    ) {}

    /*...*/
    /**
     * Returns product image URL. *
     * @return string|null
     */
    public function getImageUrl(): ?string
    {
        if ($this->storage->fileExists($this->imageFileName) !== true) {
            return null;
        }

        return $this->storage->getUrl($this->imageFileName);
    }

    /**
     * Returns whether image was successfully updated or not. *
     * @return bool
     */
    public function updateImage(): bool
    {
        /*...*/
        try {
            if ($this->storage->fileExists($this->imageFileName) !== true) {
                $this->storage->deleteFile($this->imageFileName);
            }
            $this->storage->saveFile($this->imageFileName);
        } catch (\Exception $exception) {
            /*...*/
            return false;
        }
        /*...*/
        return true;
    }
    /*...*/
}