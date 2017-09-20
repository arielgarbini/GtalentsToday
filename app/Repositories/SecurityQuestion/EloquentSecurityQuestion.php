<?php

namespace Vanguard\Repositories\SecurityQuestion;

use Vanguard\SecurityQuestion;
use DB;

class EloquentSecurityQuestion implements SecurityQuestionRepository
{
    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return SecurityQuestion::all();
    }

    /**
     * {@inheritdoc}
     */
    public function find($id)
    {
        return SecurityQuestion::find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $data)
    {
        $question = SecurityQuestion::create($data);

      //  event(new Created($question));

        return $question;
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $question = $this->find($id);

        $question->update($data);

        Cache::flush();

        //event(new Updated($question));

        return $question;
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id)
    {
        $question = $this->find($id);

        //event(new Deleted($question));

        $status = $question->delete();

        Cache::flush();

        return $status;
    }

    /**
     * {@inheritdoc}
     */
    public function lists($language = '1', $column = 'name', $key = 'value_id')
    {
        return SecurityQuestion::where('language_id', $language)->orderBy('value_id')->lists($column, $key);
    }
}
