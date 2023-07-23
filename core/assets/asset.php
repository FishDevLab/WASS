<?php

class Assets
{

    protected string $asset;

    public function __construct(string $module)
    {
        $this->asset = $module;
    }

    public function load_asset(){
        switch($this->asset){
            case "Engines":
                Assets\Engines::
                break;
            case "Payload":
                break;
            case "Fuzzing":
                break;
            default:
                break;
        }
    }

}
?>