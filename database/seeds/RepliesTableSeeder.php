<?php

use Illuminate\Database\Seeder;
use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;

class RepliesTableSeeder extends Seeder
{
    public function run()
    {
        $userIds = User::pluck('id')->toArray();

        $topicIds = Topic::pluck('id')->toArray();

        $faker = app(Faker\Generator::class);

        $replies = factory(Reply::class)
            ->times(1000)
            ->make()
            ->each(function ($reply, $index) use($userIds, $topicIds, $faker){
                $reply->user_id = $faker->randomElement($userIds);

                $reply->topic_id = $faker->randomElement($topicIds);
            });

        Reply::insert($replies->toArray());
    }

}
