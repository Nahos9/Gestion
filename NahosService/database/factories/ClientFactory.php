<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $pays = $this->faker->country;
        $ville = $this->faker->city;
        return [
            "nom"=>$this->faker->firstName,
            "prenom"=>$this->faker->lastName,
            "sexe"=>array_rand(["H","F"],1),
            "dateNaissance"=>$this->faker->dateTimeBetween("1980-01-31","2000-12-31"),
            "lieuNaissance"=> "$pays . $ville",
            "nationalite"=>$this->faker->country,
            "ville"=>$ville,
            "pays"=>$pays,
            "adresse"=>$this->faker->address,
            "telephone1"=>$this->faker->phoneNumber,
            "telephone2"=>$this->faker->phoneNumber,
            "pieceIdentite"=>array_rand(["CNI","PASSPORT","PERMIS DE CONDUIRE"],1),
            "noPieceIdentite"=>$this->faker->creditCardNumber
        ];
    }
}
