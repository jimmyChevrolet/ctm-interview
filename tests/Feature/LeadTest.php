<?php

namespace Tests\Feature;

use App\Lead;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LeadTest extends TestCase
{
    use WithFaker;
    /**
     * expected structure of a returned paginated list of leads
     *
     * @var array
     */
    private $leadIndexStructure = [
        'current_page',
        'data'
    ];

    /**
     * expected structure of a single lead being returned
     *
     * @var array
     */
    private $singleLeadStructure = [
        'id',
        'first_name',
        'last_name',
        'email',
        'opt',
        'created_at',
        'updated_at'
    ];

    /**
     * Test lead index endpoint
     *
     * @return void
     */
    public function testLeadIndex(){
        $resp = $this->getJson('/api/lead');

        $resp->assertStatus(200);
        $resp->assertJsonStructure($this->leadIndexStructure);
    }

    /**
     * Test for endpoint grabbing a single lead
     *
     * @return void
     */
    public function testLeadGet(){
        $lead = Lead::first();


        $resp = $this->getJson("/api/lead/{$lead->id}");
        $resp->assertStatus(200);
        $resp->assertJsonStructure($this->singleLeadStructure);
    }

    /**
     * Test for lead creation endpoint
     *
     * @return void
     */
    public function testLeadPost(){
        $lead = [
            'first_name' => 'test',
            'last_name' => 'testing',
            'email' => 'test@testing.com',
            'opt' => true
        ];

        $resp = $this->postJson('/api/lead',$lead);

        $resp->assertStatus(201);
    }
}
