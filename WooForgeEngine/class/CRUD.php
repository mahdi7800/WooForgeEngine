<?php

abstract class  CRUD
{
    abstract protected function wooen_insert();
    abstract protected function wooen_update();
    abstract protected function wooen_delete();
    abstract protected function wooen_select();

    public function wooen_handle_admin_actions(): void
    {
        $this->wooen_insert();
        $this->wooen_update();
        $this->wooen_delete();
    }

}
