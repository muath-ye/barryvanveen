<?php
namespace Barryvanveen\Comments;

use Barryvanveen\Database\EloquentRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CommentRepository extends EloquentRepository
{
    /**
     * return all comments.
     *
     * @return array|static[]
     */
    public function all()
    {
        return Comment::orderedNewToOld()->get();
    }

    /**
     * retrieve a comment by its id.
     *
     * @param int $id
     *
     * @return Comment
     *
     * @throws ModelNotFoundException
     */
    public function findById($id)
    {
        return Comment::findOrFail($id);
    }
}