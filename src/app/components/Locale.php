<?php

namespace component\Locale;

use Phalcon\Di\Injectable;
use Phalcon\Translate\Adapter\NativeArray;
use Phalcon\Translate\InterpolatorFactory;
use Phalcon\Translate\TranslateFactory;
use App\Middleware\Middleware;

class Locale extends Injectable
{
    /**
     * @return NativeArray
     */
    public function getTranslator(): NativeArray
    {
        $language = Middleware::boot();
        $messages = [];

        $translationFile = APP_PATH . '/messages/' . $language . '.php';

        if (true !== file_exists($translationFile)) {
            $translationFile = APP_PATH . '/messages/en-GB.php';
        }
        require $translationFile;

        $interpolator = new InterpolatorFactory();
        $factory = new TranslateFactory($interpolator);
        $di = $this->getDI();

        return $factory->newInstance(
            'array',
            [
                'content' => $messages,
            ]
        );
    }
}
