<?php

namespace App\DTO;

class UserDTO
{
    /**
     * @param string $name
     * @param string $surname
     * @param string $email
     * @param mixed $birthday
     * @param bool $congratulated
     */
    public function __construct(
        private readonly string $name,
        private readonly string $surname,
        private readonly string $email,
        private readonly string $birthday,
        private readonly bool $congratulated,

    ) {

    }


    public function getName(): string
    {
        return $this->name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function getBirthday(): string
    {
        return $this->birthday;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
    public function isCongratulated(): bool
    {
        return $this->congratulated;
    }

    public static function fromArray(array $data): static
    {
        return new static(
            name: $data['name'],
            surname: $data['surname'],
            email: $data['email'],
            birthday: $data['birthday'],
            congratulated: $data['congratulated']
        );
    }
}
