<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    
    public function test_get_invoice_by_id_and_provider()
    {
        $response = $this->get('/api/invoice/vizma/1');

        $response->assertStatus(200)
                ->assertJsonStructure(
                [
                    'id',
                    'invoice-nr',
                    'seller' => [
                        'name',
                        'organisation-number',
                    ],
                    'buyer' => [
                             'name',
                             'organisation-number',
                             'invoicing' => [
                                "email",
                                "address1",
                                "address2",
                                "zip-code",
                                "state",
                                "country"
                            ],
                     ],
                    'invoice-date',
                    'due-date',
                    'delivery-date',
                    'currency',
                    'currency-rate',
                    'sent',
                    'notes',
                    'country-code',
                    'amount',
                    'rows',
                    
                ]
            );
    }
    
    
    public function test_should_return_418_for_invoiceid_2()
    {
        $response = $this->get('/api/invoice/vizma/2');
        $response->assertStatus(418);
    }
}
