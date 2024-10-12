<?php

function identifyRequiredResponse($placement){
	return explode(".",explode("/", $_SERVER['REQUEST_URI'])[$placement])[1];
}