<?php

    /**
     *
     * Set active css class if the specific URI is current URI
     *
     * @param string $path       A specific URI
     * @param string $class_name Css class name, optional
     * @return string            Css class name if it's current URI,
     *                           otherwise - empty string
     */
    function isActiveRoute($path, $class_name = 'current_section')
    {
        return Request::segment(1) === $path ? $class_name : "";
    }