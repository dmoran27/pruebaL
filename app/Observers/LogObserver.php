<?php

namespace App\Observers;
use App\Log;
class LogObserver
{
    //
    
    public function saved($model)
    {
        if ($model->wasRecentlyCreated == true) {
            // Data was just created
            
            $action = 'Crear';
        } else {
            // Data was updated
            $action = 'Actualizar';
        }
        Log::create([
            'action'       => $action,
            'action_model' => $model->getTable(),
            'action_id'    => $model->id
        ]);
    }


    public function deleting($model)
    {
        Log::create([
            'action'       => 'Eliminar',
            'action_model' => $model->getTable(),
            'action_id'    => $model->id
        ]);
        
    }
}
