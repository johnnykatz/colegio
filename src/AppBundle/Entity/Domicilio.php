<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * Domicilio
 *
 * @ORM\Table(name="domicilios")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DomicilioRepository")
 */
class Domicilio
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="numeracion", type="string", length=10, nullable=true)
     */
    private $numeracion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="piso", type="string", length=10, nullable=true)
     */
    private $piso;

    /**
     * @var string
     *
     * @ORM\Column(name="departamento_c", type="string", length=10, nullable=true)
     */
    private $departamentoC;
    
     /**
     * @ORM\ManyToOne(targetEntity="TipoDomicilio")
     * @ORM\JoinColumn(name="tipo_domicilio_id", referencedColumnName="id")
     */
    private $tipoDomicilio;
    
     /**
     * @ORM\ManyToOne(targetEntity="Calle")
     * @ORM\JoinColumn(name="calle_id", referencedColumnName="id")
     */
    private $calle;
    
     /**
     * @ORM\ManyToOne(targetEntity="UbicacionBundle\Entity\Localidad")
     * @ORM\JoinColumn(name="localidad_id", referencedColumnName="id")
     */
    private $localidad;
    
    /**
     * @ORM\ManyToOne(targetEntity="Colegiado",inversedBy="domicilios")
     * @ORM\JoinColumn(name="colegiado_id", referencedColumnName="id")
     */
    private $colegiado;

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
     * Set numeracion
     *
     * @param string $numeracion
     *
     * @return Domicilio
     */
    public function setNumeracion($numeracion)
    {
        $this->numeracion = $numeracion;

        return $this;
    }

    /**
     * Get numeracion
     *
     * @return string
     */
    public function getNumeracion()
    {
        return $this->numeracion;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Domicilio
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set piso
     *
     * @param string $piso
     *
     * @return Domicilio
     */
    public function setPiso($piso)
    {
        $this->piso = $piso;

        return $this;
    }

    /**
     * Get piso
     *
     * @return string
     */
    public function getPiso()
    {
        return $this->piso;
    }

    /**
     * Set departamentoC
     *
     * @param string $departamentoC
     *
     * @return Domicilio
     */
    public function setDepartamentoC($departamentoC)
    {
        $this->departamentoC = $departamentoC;

        return $this;
    }

    /**
     * Get departamentoC
     *
     * @return string
     */
    public function getDepartamentoC()
    {
        return $this->departamentoC;
    }

    /**
     * Set creado
     *
     * @param \DateTime $creado
     *
     * @return Domicilio
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
     * @return Domicilio
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
     * Set tipoDomicilio
     *
     * @param \AppBundle\Entity\TipoDomicilio $tipoDomicilio
     *
     * @return Domicilio
     */
    public function setTipoDomicilio(\AppBundle\Entity\TipoDomicilio $tipoDomicilio = null)
    {
        $this->tipoDomicilio = $tipoDomicilio;

        return $this;
    }

    /**
     * Get tipoDomicilio
     *
     * @return \AppBundle\Entity\TipoDomicilio
     */
    public function getTipoDomicilio()
    {
        return $this->tipoDomicilio;
    }

    /**
     * Set calle
     *
     * @param \AppBundle\Entity\Calle $calle
     *
     * @return Domicilio
     */
    public function setCalle(\AppBundle\Entity\Calle $calle = null)
    {
        $this->calle = $calle;

        return $this;
    }

    /**
     * Get calle
     *
     * @return \AppBundle\Entity\Calle
     */
    public function getCalle()
    {
        return $this->calle;
    }

    /**
     * Set localidad
     *
     * @param \UbicacionBundle\Entity\Localidad $localidad
     *
     * @return Domicilio
     */
    public function setLocalidad(\UbicacionBundle\Entity\Localidad $localidad = null)
    {
        $this->localidad = $localidad;

        return $this;
    }

    /**
     * Get localidad
     *
     * @return \UbicacionBundle\Entity\Localidad
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * Set colegiado
     *
     * @param \AppBundle\Entity\Colegiado $colegiado
     *
     * @return Domicilio
     */
    public function setColegiado(\AppBundle\Entity\Colegiado $colegiado = null)
    {
        $this->colegiado = $colegiado;

        return $this;
    }

    /**
     * Get colegiado
     *
     * @return \AppBundle\Entity\Colegiado
     */
    public function getColegiado()
    {
        return $this->colegiado;
    }

    /**
     * Set creadoPor
     *
     * @param \UsuariosBundle\Entity\Usuario $creadoPor
     *
     * @return Domicilio
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
     * @return Domicilio
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
}
