<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\CoordinatesAddRepo;
use App\Exception\ValidationException;

/**
 * Service.
 */
final class CoordinatesAdd
{
    /**
     * @var CoordinatesAddRepo
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param CoordinatesAddRepo $repository The repository
     */
    public function __construct(CoordinatesAddRepo $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new user.
     *
     * @param array $data The form data
     *
     * @return int The new user ID
     */
    public function createUser(array $data): int
    {
        // Input validation
        $this->validateNewUser($data);

        // Insert user
        $coo = $this->repository->insertCoo($data);

        // Logging here: User created successfully
        //$this->logger->info(sprintf('User created successfully: %s', $userId));

        return $coo;
    }

    /**
     * Input validation.
     *
     * @param array $data The form data
     *
     * @throws ValidationException
     *
     * @return void
     */
    private function validateNewUser(array $data): void
    {
        $errors = [];

        // Here you can also use your preferred validation library

        if (empty($data['city'])) {
            $errors['city'] = 'Input required';
        }

        if (empty($data['country'])) {
            $errors['country'] = 'Input required';
        }

        if ($errors) {
            throw new ValidationException('Please check your input', $errors);
        }
    }
}