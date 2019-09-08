<?php
    class UnauthorizedException extends Exception{
        function __construct($message=""){ 
            parent::__construct($message);
        }
    }

    class UnregisteredKernelException extends Exception{
        function __construct($message=""){
            parent::__construct($message);
        }
    }
    class UnresolvedRouteException extends Exception{
        function __construct($message=""){
            parent::__construct($message);
        }
    }
    

?>