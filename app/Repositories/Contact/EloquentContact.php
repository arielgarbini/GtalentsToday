<?php

namespace Vanguard\Repositories\Contact;

use Vanguard\Contact;
use DB;

class EloquentContact implements ContactRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Contact::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Contact::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $contact = Contact::create($data);

      //  event(new Created($contact));

        return $contact;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $contact = $this->find($id);

        $contact->update($data);

        Cache::flush();

        //event(new Updated($contact));

        return $contact;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $contact = $this->find($id);

        //event(new Deleted($contact));

        $status = $contact->delete();

        Cache::flush();

        return $status;
    }

    /**
     * {@inheritdoc}
     */
    public function lists($language = '1', $column = 'name', $key = 'value_id')
    {
        return Contact::where('language_id', $language)->orderBy('value_id')->lists($column, $key);
    }
}
