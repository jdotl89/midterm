<?php

/**
 * Class Controller
 */
class Controller
{

    /**
     * Controller constructor.
     */
    public function __construct()
    {

    }

    public function home()
    {
        $view = new Template();
        echo $view->render('views/home.html');
    }

    public function getCheckbox()
    {
        $checkbox = array("This midterm is easy", "I like midterms", "Today is Wednesday");

        return $checkbox;

              /*  <div class="col-sm-12">
                    <repeat group="{{ @indoor }}" value="{{ @in }}">
                        <label class="col-md-2 mr-4 ml-2"><input type="checkbox"
                                      name="indoor[]"
                                      value="{{ @in }}"> {{ ucfirst(@in) }}</label>
                    </repeat>
                </div>*/
    }

}