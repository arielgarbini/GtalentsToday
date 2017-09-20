<?php

namespace Vanguard\Repositories\Invoice;

use Vanguard\Invoice;
use DB;

class EloquentInvoice implements InvoiceRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return Invoice::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return Invoice::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $invoice = Invoice::create($data);

      //  event(new Created($invoice));

        return $invoice;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $invoice = $this->find($id);

        $invoice->update($data);

        Cache::flush();

        //event(new Updated($invoice));

        return $invoice;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $invoice = $this->find($id);

        //event(new Deleted($invoice));

        $status = $invoice->delete();

        Cache::flush();

        return $status;
    }

    /**
     * {@inheritdoc}
     */
    public function lists($column = 'number', $key = 'id')
    {
        return Invoice::orderBy('number')->lists($column, $key);
    }
}
