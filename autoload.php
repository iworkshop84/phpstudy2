<?php

require __DIR__ . '/vendor/autoload.php';

function my_autoload($class)
{
    /* Старый вариант автозагрузки который исполбзовался до неймспейсов
     * Оставил для примера
     *
    if (file_exists(__DIR__ . '/controllers/' . $class . '.php')) {
        require __DIR__ . '/controllers/' . $class . '.php';
    } elseif (file_exists(__DIR__ . '/models/' . $class . '.php')) {
        require __DIR__ . '/models/' . $class . '.php';
    } elseif (file_exists(__DIR__ . '/classes/' . $class . '.php')) {
        require __DIR__ . '/classes/' . $class . '.php';
    }
    */

        $classParts = explode('\\', $class);
        $classParts[0] = __DIR__;
        $path = implode(DIRECTORY_SEPARATOR, $classParts) . '.php';

        if(file_exists($path))
        {
            require $path;
        }

}

spl_autoload_register('my_autoload');