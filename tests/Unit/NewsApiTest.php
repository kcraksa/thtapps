<?php

namespace Tests\Unit;

use Faker\Factory as Faker;

use App\Models\User;
use App\Models\Topics;
use App\Models\News;
use Tests\TestCase;

class NewsApiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function test_get_all_news()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->getJson('/api/news');

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true
            ]);
    }

    public function test_get_all_news_with_filter()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->getJson('/api/news?search_news_status=draft&search_topic=1');

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true
            ]);
    }

    public function test_store_news()
    {
        $faker = Faker::create('id_ID');

        $user = User::factory()->create();
        $topics = Topics::create(['topic' => $faker->word]);

        $response = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->json('post', 'api/news', [
                            'topics_id' => $topics->id,
                            'title' => $faker->text($maxNbChars = 100),
                            'content' => $faker->randomHtml(2,3),
                            'status' => 'draft',
                            'tags' => $faker->words($nb = 5, $asText = false)
                         ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true
            ]);
    }

    public function test_get_news_byId()
    {
        $user = User::factory()->create();
        $id = rand(1,15);

        $response = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->json('get', 'api/news/'.$id, []);

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true
            ]);
    }

    public function test_update_news()
    {
        $faker = Faker::create('id_ID');

        $user = User::factory()->create();
        $news = News::inRandomOrder()->first();
        $topics = Topics::inRandomOrder()->first();

        $response = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->json('put', 'api/news/'.$news->id, [
                            'topics_id' => $topics->id,
                            'title' => $faker->text($maxNbChars = 100),
                            'content' => $faker->randomHtml(2,3),
                            'tags' => $faker->words($nb = 5, $asText = false)
                         ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true
            ]);
    }

    public function test_publish_news()
    {
        $news = News::inRandomOrder()->first();
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->json('put', 'api/news/'.$news->id.'/publish', [
                            'status' => 'publish'
                         ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true
            ]);
    }

    public function test_delete_news()
    {
        $news = News::inRandomOrder()->first();
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->withSession(['banned' => false])
                         ->json('delete', 'api/news/'.$news->id, []);

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true
            ]);
    }
}
