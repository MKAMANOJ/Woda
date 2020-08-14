<?php

namespace App\Services;

use App\Models\Setting;
use App\Repositories\Settings\SettingsRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Psr\Log\LoggerInterface;

/**
 * Class SettingsService
 * @package App\Services
 */
class SettingsService
{
    /**
     * @var SettingsRepositoryInterface
     */
    protected $settingRepository;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * SettingsService constructor.
     * @param SettingsRepositoryInterface $settings
     * @param LoggerInterface             $logger
     */
    public function __construct(SettingsRepositoryInterface $settings, LoggerInterface $logger)
    {
        $this->settingRepository = $settings;
        $this->logger            = $logger;
    }

    /**
     * Get all system settings
     * @return mixed
     */
    public function getAll()
    {
        return $this->settingRepository->getAll();
    }

    /**
     * Get setting from id.
     * @param $id
     * @return mixed
     */
    public function getById(int $id)
    {
        try {
            return $this->settingRepository->find($id);
        } catch (ModelNotFoundException $exception) {
            return false;
        }
    }

    /**
     * Create new system setting
     * @param array $inputData
     * @return mixed
     */
    public function create(array $inputData)
    {
        try {
            $setting = $this->settingRepository->store($inputData);
            $this->logger->info(sprintf('Created new setting with id: %s', $setting->id));
        } catch (\Exception $exception) {
            $this->logger->info(sprintf('Unable to create new setting because %s', $exception->getMessage()));

            return false;
        }

        return true;
    }

    /**
     * Update System Settings
     * @param       $setting
     * @param array $inputData
     * @return mixed
     */
    public function update(Setting $setting, array $inputData)
    {
        try {
            $this->settingRepository->update($setting, $inputData);
            $this->logger->info(sprintf('Updated the setting with id: %s', $setting->id));
        } catch (\Exception $exception) {
            $this->logger->info(sprintf('Unable to update the setting because %s', $exception->getMessage()));

            return false;
        }

        return true;
    }
}
