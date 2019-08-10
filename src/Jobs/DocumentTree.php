<?php

namespace Laramate\StructuredDocument\Jobs;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Laramate\Nucid\Job\Models\Job;
use Laramate\StructuredDocument\Models\Document;

class DocumentTree extends Job
{
    /**
     * Parent ID.
     *
     * @var int
     */
    protected $parent_id;

    /**
     * Slug.
     *
     * @var string|null
     */
    protected $slug;

    /**
     * DocumentTree constructor.
     *
     * @param int|null    $parentId
     * @param string|null $slug
     */
    public function __construct(int $parentId = null, string $slug = null)
    {
        $this->parent_id = $parentId;
        $this->slug = $slug;
    }

    /**
     * Handle the job.
     *
     * @return Collection
     */
    public function handle()
    {
        $tree = Document::with(['children']);

        return $this->addParentWhere($tree)->get();
    }

    /**
     * Add parent where condition.
     *
     * @param Builder $tree
     *
     * @return Builder
     */
    protected function addParentWhere(Builder $tree): Builder
    {
        if ($this->parent_id) {
            return $tree->where('parent_id', $this->parent_id);
        }

        if ($this->slug) {
            return $tree->where('slug', $this->slug);
        }

        return $tree->whereNull('parent_id');
    }
}
