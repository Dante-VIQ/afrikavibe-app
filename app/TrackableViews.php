<?php

namespace App;

use App\Models\ContentView;

trait TrackableViews
{
    public function views(){
        return $this->morphMany(ContentView::class, 'viewable');
    }

    public function getViewsCountAttributes() {
        return $this->views()->count();
    }
}
