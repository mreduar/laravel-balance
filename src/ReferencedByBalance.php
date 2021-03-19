<?php

namespace MrEduar\Balance;

trait ReferencedByBalance
{
    /**
     * Get all of the model's balance references.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function balanceReferences()
    {
        return $this->morphMany(Balance::class, 'referenceable');
    }
}
