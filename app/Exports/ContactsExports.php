<?php

namespace App\Exports;

use App\Models\Contact;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ContactsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $organisationId;

    public function __construct(int $organisationId)
    {
        $this->organisationId = $organisationId;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Contact::where('organisation_id', $this->organisationId)
            ->with('organisation')
            ->orderBy('last_name')
            ->get();
    }
    
    /**
     * Define the column headers for the export file.
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Organization',
            'First Name',
            'Last Name',
            'Job Title',
            'Email',
            'Phone',
            'Created At',
        ];
    }
    
    /**
     * Map the database row to the export row.
     * @param mixed $contact
     * @return array
     */
    public function map($contact): array
    {
        return [
            $contact->id,
            $contact->organisation->name, 
            $contact->first_name,
            $contact->last_name,
            $contact->job_title,
            $contact->email,
            $contact->phone,
            $contact->created_at->format('Y-m-d H:i:s'),
        ];
    }
}