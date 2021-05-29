<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Member;
use App\Repositories\MemberRepository;

trait MakeMemberTrait
{
    /**
     * Create fake instance of Member and save it in database
     *
     * @param array $memberFields
     * @return Member
     */
    public function makeMember($memberFields = [])
    {
        /** @var MemberRepository $memberRepo */
        $memberRepo = \App::make(MemberRepository::class);
        $theme = $this->fakeMemberData($memberFields);
        return $memberRepo->create($theme);
    }

    /**
     * Get fake instance of Member
     *
     * @param array $memberFields
     * @return Member
     */
    public function fakeMember($memberFields = [])
    {
        return new Member($this->fakeMemberData($memberFields));
    }

    /**
     * Get fake data of Member
     *
     * @param array $memberFields
     * @return array
     */
    public function fakeMemberData($memberFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $memberFields);
    }
}
