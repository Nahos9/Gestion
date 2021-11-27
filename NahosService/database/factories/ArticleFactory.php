<?php

namespace Database\Factories;

use App\Models\Article;
use Faker\Guesser\Name;
use Illuminate\Database\Eloquent\Factories\Factory;
use phpDocumentor\Reflection\Types\Boolean;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "nom"=>$this->faker->sentence,
            "noSerie"=>$this->faker->swiftBicNumber,
            "estDisponible"=>rand(0,1),
            "imageUrl"=>"img/photo.png",
            "type_article_id"=>rand(1,4)     
          ];
    }
}
