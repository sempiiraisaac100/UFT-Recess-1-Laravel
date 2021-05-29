<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeMemberTrait;
use Tests\ApiTestTrait;

class MemberApiTest extends TestCase
{
    use MakeMemberTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_member()
    {
        $member = $this->fakeMemberData();
        $this->response = $this->json('POST', '/api/members', $member);

        $this->assertApiResponse($member);
    }

    /**
     * @test
     */
    public function test_read_member()
    {
        $member = $this->makeMember();
        $this->response = $this->json('GET', '/api/members/'.$member->id);

        $this->assertApiResponse($member->toArray());
    }

    /**
     * @test
     */
    public function test_update_member()
    {
        $member = $this->makeMember();
        $editedMember = $this->fakeMemberData();

        $this->response = $this->json('PUT', '/api/members/'.$member->id, $editedMember);

        $this->assertApiResponse($editedMember);
    }

    /**
     * @test
     */
    public function test_delete_member()
    {
        $member = $this->makeMember();
        $this->response = $this->json('DELETE', '/api/members/'.$member->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/members/'.$member->id);

        $this->response->assertStatus(404);
    }
}
