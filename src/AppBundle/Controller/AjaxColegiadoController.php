<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AjaxColegiadoController extends Controller {

   
    public function getImagenesHojasAction(Request $request) {


        $documentoId = $request->query->get('documentoId');

        if (!$documentoId) {
            $entities = false;
        } else {

            $em = $this->getDoctrine()->getManager();
            $entities = $em->getRepository('AppBundle:Hoja')->findByDocumento($documentoId);
            $html = $this->renderView(
                    'AppBundle:Colegiado:imagenesHojasBody.html.twig', array(
                'entity' => $entities,
                    )
            );
        }

        return new JsonResponse($html);
    }
    
    public function getCalleByNombreCodigoAction( Request $request ) {

		$calleCriteria = trim( $request->get( 'term' ) );
		$searchMethod    = $request->get( 'search_method' );

//		$getProperty = ucwords( trim( $request->get( 'search_method' ) ) );
		$em = $this->getDoctrine()->getManagerForClass( $request->get( 'class' ) );

		$resultados = $em->getRepository( $request->get( 'class' ) )->$searchMethod( $calleCriteria );

		$retorno = array();

		if ( ! count( $resultados ) ) {
			$retorno[] = array(
				'label' => 'No se encontraron coincidencias',
				'value' => ''
			);
		} else {

			foreach ( $resultados as $calle ) {

				$nombre  = $calle->getnombre();
				$codigo    = $calle->getCodigo();
				$retorno[] = array(
					'id'    => $calle->getId(),
					'label' => sprintf( '%s - %s',
						$codigo,
						$nombre
					),
					'value' => sprintf( '%s - %s', $codigo, $nombre )
				);
			}
		}

//		$retorno = json_encode( $retorno );
//
//		return new Response( $retorno, 200, array( 'Content-Type' => 'application/json' ) );
		return new JsonResponse( $retorno );

	}
        
        public function getLocalidadByNombreAction( Request $request ) {

		$localidadCriteria = trim( $request->get( 'term' ) );
		$searchMethod    = $request->get( 'search_method' );

//		$getProperty = ucwords( trim( $request->get( 'search_method' ) ) );
		$em = $this->getDoctrine()->getManagerForClass( $request->get( 'class' ) );

		$resultados = $em->getRepository( $request->get( 'class' ) )->$searchMethod( $localidadCriteria );

		$retorno = array();

		if ( ! count( $resultados ) ) {
			$retorno[] = array(
				'label' => 'No se encontraron coincidencias',
				'value' => ''
			);
		} else {

			foreach ( $resultados as $localidad ) {

				$nombreLocalidad  = $localidad->getDescripcion();
				$departamento    = $localidad->getDepartamento()->getDescripcion();
				$retorno[] = array(
					'id'    => $localidad->getId(),
					'label' => sprintf( '%s - %s',
						$nombreLocalidad,
						$departamento
					),
					'value' => sprintf( '%s - %s', $nombreLocalidad, $departamento )
				);
			}
		}

//		$retorno = json_encode( $retorno );
//
//		return new Response( $retorno, 200, array( 'Content-Type' => 'application/json' ) );
		return new JsonResponse( $retorno );

	}

 
}
