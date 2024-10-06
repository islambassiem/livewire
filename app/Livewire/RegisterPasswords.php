<?php

namespace App\Livewire;

use Illuminate\Support\Str;
use Livewire\Component;
use ZxcvbnPhp\Zxcvbn;

class RegisterPasswords extends Component
{

    public string $password = '';

    public string $passwordConfirmation = '';

    public int $strengthScore = 0;

    public array $strengthLevels = [
        1 => 'Weak',
        2 => 'Fair',
        3 => 'Good',
        4 => 'Strong',
    ];

    public function updatedPassword($value)
    {
        $this->strengthScore = (new Zxcvbn())->passwordStrength($value)['score'];
    }

    public function updatePassword(){
        $this->updatedPassword($this->password);
    }

    public function generatePassword(): void
    {
        $password = Str::password(12);
        $this->setPassword($password);
    }

    protected function setPassword($value): void
    {
        $this->password = $value;
        $this->passwordConfirmation = $value;
        $this->updatedPassword($value);
    }

    public function render()
    {
        return view('livewire.register-passwords');
    }
}
