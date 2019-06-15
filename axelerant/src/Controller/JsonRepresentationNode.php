<?php

namespace Drupal\axelerant\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\Core\Config\ConfigFactoryInterface;


class JsonRepresentationNode extends ControllerBase {

	public function nodedata($nodeid) {
		if($nodeid != ""){
			$json_array = array(
				'data' => array()
			);
			$api_key = \Drupal::config('axelerant.setting')->get('site_api_key');
			$node_details = Node::load($nodeid); //Get the Node details using NodeId
			$json_array['data'][] = array(
				'id' => $node_details->get('nid')->value,
				'type' => $node_details->get('type')->target_id,
				'api_key' => $api_key,
				'attributes' => array(
				  'title' =>  $node_details->get('title')->value,
				  'content' => $node_details->get('body')->value,
				),
			);
			return new JsonResponse($json_array); // Return The JSON response.
		}else{
			throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException();
		}
	}
}




