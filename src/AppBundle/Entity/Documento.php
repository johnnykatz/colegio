<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Documento
 *
 * @ORM\Table(name="documentos")
 * @ORM\Entity
 */
class Documento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var text
     *
     * @ORM\Column(name="descripcion", type="text",nullable=true)
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ingreso", type="date")
     */
    private $fechaIngreso;

    
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Expediente",inversedBy="documentos")
     * @ORM\JoinColumn(name="expediente_id", referencedColumnName="id")
     */
    private $expediente;
    
    /**
     * @ORM\ManyToOne(targetEntity="TipoDocumentoExpediente",inversedBy="documentos")
     * @ORM\JoinColumn(name="tipo_documento_expediente_id", referencedColumnName="id")
     */
    private $tipoDocumentoExpediente;
    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Hoja", mappedBy="documento",cascade={"persist", "remove"})
     * @ORM\OrderBy({"numero" = "ASC"})
     */
    private $hojas;

     /**
     * @var datetime $creado
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="creado", type="datetime")
     */
    private $creado;

    /**
     * @var datetime $actualizado
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="actualizado",type="datetime")
     */
    private $actualizado;

    /**
     * @var integer $creadoPor
     *
     * @Gedmo\Blameable(on="create")
     * @ORM\ManyToOne(targetEntity="UsuariosBundle\Entity\Usuario")
     * @ORM\JoinColumn(name="creado_por", referencedColumnName="id", nullable=true)
     */
    private $creadoPor;

    /**
     * @var integer $actualizadoPor
     *
     * @Gedmo\Blameable(on="update")
     * @ORM\ManyToOne(targetEntity="UsuariosBundle\Entity\Usuario")
     * @ORM\JoinColumn(name="actualizado_por", referencedColumnName="id", nullable=true)
     */
    private $actualizadoPor;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Documento
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set fechaIngreso
     *
     * @param \DateTime $fechaIngreso
     *
     * @return Documento
     */
    public function setFechaIngreso($fechaIngreso)
    {
        $this->fechaIngreso = $fechaIngreso;

        return $this;
    }

    /**
     * Get fechaIngreso
     *
     * @return \DateTime
     */
    public function getFechaIngreso()
    {
        return $this->fechaIngreso;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     *
     * @return Documento
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden
     *
     * @return integer
     */
    public function getOrden()
    {
        return $this->orden;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->hojas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set creado
     *
     * @param \DateTime $creado
     *
     * @return Documento
     */
    public function setCreado($creado)
    {
        $this->creado = $creado;

        return $this;
    }

    /**
     * Get creado
     *
     * @return \DateTime
     */
    public function getCreado()
    {
        return $this->creado;
    }

    /**
     * Set actualizado
     *
     * @param \DateTime $actualizado
     *
     * @return Documento
     */
    public function setActualizado($actualizado)
    {
        $this->actualizado = $actualizado;

        return $this;
    }

    /**
     * Get actualizado
     *
     * @return \DateTime
     */
    public function getActualizado()
    {
        return $this->actualizado;
    }

    /**
     * Set expediente
     *
     * @param \AppBundle\Entity\Expediente $expediente
     *
     * @return Documento
     */
    public function setExpediente(\AppBundle\Entity\Expediente $expediente = null)
    {
        $this->expediente = $expediente;

        return $this;
    }

    /**
     * Get expediente
     *
     * @return \AppBundle\Entity\Expediente
     */
    public function getExpediente()
    {
        return $this->expediente;
    }

    /**
     * Add hoja
     *
     * @param \AppBundle\Entity\Hoja $hoja
     *
     * @return Documento
     */
    public function addHoja(\AppBundle\Entity\Hoja $hoja)
    {
        $this->hojas[] = $hoja;

        return $this;
    }

    /**
     * Remove hoja
     *
     * @param \AppBundle\Entity\Hoja $hoja
     */
    public function removeHoja(\AppBundle\Entity\Hoja $hoja)
    {
        $this->hojas->removeElement($hoja);
    }

    /**
     * Get hojas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHojas()
    {
        return $this->hojas;
    }

    /**
     * Set creadoPor
     *
     * @param \UsuariosBundle\Entity\Usuario $creadoPor
     *
     * @return Documento
     */
    public function setCreadoPor(\UsuariosBundle\Entity\Usuario $creadoPor = null)
    {
        $this->creadoPor = $creadoPor;

        return $this;
    }

    /**
     * Get creadoPor
     *
     * @return \UsuariosBundle\Entity\Usuario
     */
    public function getCreadoPor()
    {
        return $this->creadoPor;
    }

    /**
     * Set actualizadoPor
     *
     * @param \UsuariosBundle\Entity\Usuario $actualizadoPor
     *
     * @return Documento
     */
    public function setActualizadoPor(\UsuariosBundle\Entity\Usuario $actualizadoPor = null)
    {
        $this->actualizadoPor = $actualizadoPor;

        return $this;
    }

    /**
     * Get actualizadoPor
     *
     * @return \UsuariosBundle\Entity\Usuario
     */
    public function getActualizadoPor()
    {
        return $this->actualizadoPor;
    }


    /**
     * Set tipoDocumentoExpediente
     *
     * @param \AppBundle\Entity\TipoDocumentoExpediente $tipoDocumentoExpediente
     *
     * @return Documento
     */
    public function setTipoDocumentoExpediente(\AppBundle\Entity\TipoDocumentoExpediente $tipoDocumentoExpediente = null)
    {
        $this->tipoDocumentoExpediente = $tipoDocumentoExpediente;

        return $this;
    }

    /**
     * Get tipoDocumentoExpediente
     *
     * @return \AppBundle\Entity\TipoDocumentoExpediente
     */
    public function getTipoDocumentoExpediente()
    {
        return $this->tipoDocumentoExpediente;
    }
}
