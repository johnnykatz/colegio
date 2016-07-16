<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Colegiado
 *
 * @ORM\Table(name="colegiados")
 * @UniqueEntity("matricula")
 * @UniqueEntity("numeroDocumento")
 * @UniqueEntity("cuilCuit")
 * @UniqueEntity("matriculaFederal") 
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ColegiadoRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Colegiado {

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
     * @ORM\Column(name="apellido", type="string", length=255)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="matricula", type="string", length=255)
     */
    private $matricula;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_matricula", type="date")
     */
    private $fechaMatricula;

    /**
     * @var string
     *
     * @ORM\Column(name="folio", type="string", length=10, nullable=true)
     */
    private $folio;

    /**
     * @var string
     *
     * @ORM\Column(name="libro", type="string", length=10, nullable=true)
     */
    private $libro;

    /**
     * @var string
     *
     * @ORM\Column(name="legajo", type="string", length=30, nullable=true)
     */
    private $legajo;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_documento", type="string", length=255)
     */
    private $numeroDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="cuil_cuit", type="string", length=15, nullable=true)
     */
    private $cuilCuit;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date", nullable=true)
     */
    private $fechaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="matricula_federal", type="string", length=25, nullable=true)
     */
    private $matriculaFederal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_federal", type="date", nullable=true)
     */
    private $fechaFederal;

    /**
     * @var string
     *
     * @ORM\Column(name="libro_federal", type="string", length=10, nullable=true)
     */
    private $libroFederal;

    /**
     * @var string
     *
     * @ORM\Column(name="folio_federal", type="string", length=10, nullable=true)
     */
    private $folioFederal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inactividad", type="date", nullable=true)
     */
    private $fechaInactividad;

    /**
     * @var string
     *
     * @ORM\Column(name="cargo", type="string", length=255, nullable=true)
     */
    private $cargo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_cargo", type="date", nullable=true)
     */
    private $fechaCargo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_titulo", type="date", nullable=true)
     */
    private $fechaTitulo;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="text", nullable=true)
     */
    private $observacion;

    /**
     * @var string
     *
     * @ORM\Column(name="denuncias", type="text", nullable=true)
     */
    private $denuncias;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono1", type="string", length=30, nullable=true)
     */
    private $telefono1;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono2", type="string", length=30, nullable=true)
     */
    private $telefono2;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono3", type="string", length=30, nullable=true)
     */
    private $telefono3;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=100, nullable=true)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="path_imagen", type="string", length=255, nullable=true)
     */
    private $pathImagen;

    /**
     * @ORM\OneToMany(targetEntity="Domicilio", mappedBy="colegiado",cascade={"persist", "remove"})
     */
    private $domicilios;

    /**
     * @ORM\OneToMany(targetEntity="Expediente", mappedBy="colegiado")
     */
    private $expedientes;

    /**
     * @ORM\ManyToOne(targetEntity="Sexo")
     * @ORM\JoinColumn(name="sexo_id", referencedColumnName="id")
     */
    private $sexo;

    /**
     * @ORM\ManyToOne(targetEntity="TipoDocumento")
     * @ORM\JoinColumn(name="tipo_documento_id", referencedColumnName="id")
     */
    private $tipoDocumento;

    /**
     * @ORM\ManyToOne(targetEntity="Facultad")
     * @ORM\JoinColumn(name="facultad_id", referencedColumnName="id")
     */
    private $facultad;

    /**
     * @ORM\ManyToOne(targetEntity="Circunscripcion")
     * @ORM\JoinColumn(name="circunscripcion_id", referencedColumnName="id")
     */
    private $circunscripcion;

    /**
     * @ORM\ManyToOne(targetEntity="Situacion")
     * @ORM\JoinColumn(name="situacion_id", referencedColumnName="id")
     */
    private $situacion;

    /**
     * @ORM\ManyToOne(targetEntity="UbicacionBundle\Entity\Localidad")
     * @ORM\JoinColumn(name="localidad_nacimiento_id", referencedColumnName="id")
     */
    private $localidad;

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

   

    public function getAbsolutePath() {
        return null === $this->pathImagen ? null : $this->getUploadRootDir() . $this->getId() . '/' . $this->pathImagen;
    }

    public function getWebPath() {
        return null === $this->pathImagen ? null : $this->getUploadDir() . '/' . $this->pathImagen;
    }

    protected function getUploadRootDir() {
        // the absolute directory ruta where uploaded
        // documents should be saved
        return __DIR__ . '/../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/fotos_colegiados/';
    }
    
    /**
	 * @Assert\File(maxSize="6000000")
	 */
	private $foto;

	/**
	 * Sets foto.
	 *
	 * @param UploadedFile $foto
	 */
	public function setFoto(UploadedFile $foto = null)
	{
		$this->foto = $foto;
		// check if we have an old image path
		if (is_file($this->getAbsolutePath())) {
			// store the old name to delete after the update
			$this->temp = $this->getAbsolutePath();
			$this->pathImagen = null;
		} else {
			$this->pathImagen = 'initial';
		}
	}

	/**
	 * Get foto.
	 *
	 * @return UploadedFile
	 */
	public function getFoto()
	{
		return $this->foto;
	}

	/**
	 * @ORM\PrePersist()
	 * @ORM\PreUpdate()
	 */
	public function preUpload()
	{
		if (null !== $this->getFoto()) {
			$this->pathImagen = $this->getFoto()->getClientOriginalName();
		}
	}

	/**
	 * Called after entity persistence
	 *
	 * @ORM\PostPersist()
	 * @ORM\PostUpdate()
	 */
	public function upload()
	{
		// the file property can be empty if the field is not required
		if (null === $this->getFoto()) {
			return;
		}

		// check if we have an old image
		if (isset($this->temp)) {
			// delete the old image
			unlink($this->temp);
			// clear the temp image path
			$this->temp = null;
		}


		// use the original file name here but you should
		// sanitize it at least to avoid any security issues

		// move takes the target directory and then the
		// target filename to move to
		$this->getFoto()->move(
			$this->getUploadRootDir().  $this->getId() . '/',
			$this->getFoto()->getClientOriginalName()
		);
		$this->setPathImagen($this->getFoto()->getClientOriginalName());

		// clean up the file property as you won't need it anymore
		$this->setFoto(null);
	}

	/**
	 * @ORM\PreRemove()
	 */
	public function storeFilenameForRemove()
	{
		$this->temp = $this->getAbsolutePath();
	}

	/**
	 * @ORM\PostRemove()
	 */
	public function removeUpload()
	{
		if (isset($this->temp)) {
			unlink($this->temp);
		}
	}
   
    
    
    

    public function __toString() {
        return $this->apellido . ", " . $this->nombre;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->domicilios = new \Doctrine\Common\Collections\ArrayCollection();
        $this->expedientes = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set apellido
     *
     * @param string $apellido
     *
     * @return Colegiado
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Colegiado
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set matricula
     *
     * @param string $matricula
     *
     * @return Colegiado
     */
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;

        return $this;
    }

    /**
     * Get matricula
     *
     * @return string
     */
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * Set fechaMatricula
     *
     * @param \DateTime $fechaMatricula
     *
     * @return Colegiado
     */
    public function setFechaMatricula($fechaMatricula)
    {
        $this->fechaMatricula = $fechaMatricula;

        return $this;
    }

    /**
     * Get fechaMatricula
     *
     * @return \DateTime
     */
    public function getFechaMatricula()
    {
        return $this->fechaMatricula;
    }

    /**
     * Set folio
     *
     * @param string $folio
     *
     * @return Colegiado
     */
    public function setFolio($folio)
    {
        $this->folio = $folio;

        return $this;
    }

    /**
     * Get folio
     *
     * @return string
     */
    public function getFolio()
    {
        return $this->folio;
    }

    /**
     * Set libro
     *
     * @param string $libro
     *
     * @return Colegiado
     */
    public function setLibro($libro)
    {
        $this->libro = $libro;

        return $this;
    }

    /**
     * Get libro
     *
     * @return string
     */
    public function getLibro()
    {
        return $this->libro;
    }

    /**
     * Set legajo
     *
     * @param string $legajo
     *
     * @return Colegiado
     */
    public function setLegajo($legajo)
    {
        $this->legajo = $legajo;

        return $this;
    }

    /**
     * Get legajo
     *
     * @return string
     */
    public function getLegajo()
    {
        return $this->legajo;
    }

    /**
     * Set numeroDocumento
     *
     * @param string $numeroDocumento
     *
     * @return Colegiado
     */
    public function setNumeroDocumento($numeroDocumento)
    {
        $this->numeroDocumento = $numeroDocumento;

        return $this;
    }

    /**
     * Get numeroDocumento
     *
     * @return string
     */
    public function getNumeroDocumento()
    {
        return $this->numeroDocumento;
    }

    /**
     * Set cuilCuit
     *
     * @param string $cuilCuit
     *
     * @return Colegiado
     */
    public function setCuilCuit($cuilCuit)
    {
        $this->cuilCuit = $cuilCuit;

        return $this;
    }

    /**
     * Get cuilCuit
     *
     * @return string
     */
    public function getCuilCuit()
    {
        return $this->cuilCuit;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     *
     * @return Colegiado
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set matriculaFederal
     *
     * @param string $matriculaFederal
     *
     * @return Colegiado
     */
    public function setMatriculaFederal($matriculaFederal)
    {
        $this->matriculaFederal = $matriculaFederal;

        return $this;
    }

    /**
     * Get matriculaFederal
     *
     * @return string
     */
    public function getMatriculaFederal()
    {
        return $this->matriculaFederal;
    }

    /**
     * Set fechaFederal
     *
     * @param \DateTime $fechaFederal
     *
     * @return Colegiado
     */
    public function setFechaFederal($fechaFederal)
    {
        $this->fechaFederal = $fechaFederal;

        return $this;
    }

    /**
     * Get fechaFederal
     *
     * @return \DateTime
     */
    public function getFechaFederal()
    {
        return $this->fechaFederal;
    }

    /**
     * Set libroFederal
     *
     * @param string $libroFederal
     *
     * @return Colegiado
     */
    public function setLibroFederal($libroFederal)
    {
        $this->libroFederal = $libroFederal;

        return $this;
    }

    /**
     * Get libroFederal
     *
     * @return string
     */
    public function getLibroFederal()
    {
        return $this->libroFederal;
    }

    /**
     * Set folioFederal
     *
     * @param string $folioFederal
     *
     * @return Colegiado
     */
    public function setFolioFederal($folioFederal)
    {
        $this->folioFederal = $folioFederal;

        return $this;
    }

    /**
     * Get folioFederal
     *
     * @return string
     */
    public function getFolioFederal()
    {
        return $this->folioFederal;
    }

    /**
     * Set fechaInactividad
     *
     * @param \DateTime $fechaInactividad
     *
     * @return Colegiado
     */
    public function setFechaInactividad($fechaInactividad)
    {
        $this->fechaInactividad = $fechaInactividad;

        return $this;
    }

    /**
     * Get fechaInactividad
     *
     * @return \DateTime
     */
    public function getFechaInactividad()
    {
        return $this->fechaInactividad;
    }

    /**
     * Set cargo
     *
     * @param string $cargo
     *
     * @return Colegiado
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;

        return $this;
    }

    /**
     * Get cargo
     *
     * @return string
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Set fechaCargo
     *
     * @param \DateTime $fechaCargo
     *
     * @return Colegiado
     */
    public function setFechaCargo($fechaCargo)
    {
        $this->fechaCargo = $fechaCargo;

        return $this;
    }

    /**
     * Get fechaCargo
     *
     * @return \DateTime
     */
    public function getFechaCargo()
    {
        return $this->fechaCargo;
    }

    /**
     * Set fechaTitulo
     *
     * @param \DateTime $fechaTitulo
     *
     * @return Colegiado
     */
    public function setFechaTitulo($fechaTitulo)
    {
        $this->fechaTitulo = $fechaTitulo;

        return $this;
    }

    /**
     * Get fechaTitulo
     *
     * @return \DateTime
     */
    public function getFechaTitulo()
    {
        return $this->fechaTitulo;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     *
     * @return Colegiado
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * Get observacion
     *
     * @return string
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * Set denuncias
     *
     * @param string $denuncias
     *
     * @return Colegiado
     */
    public function setDenuncias($denuncias)
    {
        $this->denuncias = $denuncias;

        return $this;
    }

    /**
     * Get denuncias
     *
     * @return string
     */
    public function getDenuncias()
    {
        return $this->denuncias;
    }

    /**
     * Set telefono1
     *
     * @param string $telefono1
     *
     * @return Colegiado
     */
    public function setTelefono1($telefono1)
    {
        $this->telefono1 = $telefono1;

        return $this;
    }

    /**
     * Get telefono1
     *
     * @return string
     */
    public function getTelefono1()
    {
        return $this->telefono1;
    }

    /**
     * Set telefono2
     *
     * @param string $telefono2
     *
     * @return Colegiado
     */
    public function setTelefono2($telefono2)
    {
        $this->telefono2 = $telefono2;

        return $this;
    }

    /**
     * Get telefono2
     *
     * @return string
     */
    public function getTelefono2()
    {
        return $this->telefono2;
    }

    /**
     * Set telefono3
     *
     * @param string $telefono3
     *
     * @return Colegiado
     */
    public function setTelefono3($telefono3)
    {
        $this->telefono3 = $telefono3;

        return $this;
    }

    /**
     * Get telefono3
     *
     * @return string
     */
    public function getTelefono3()
    {
        return $this->telefono3;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return Colegiado
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    
    /**
     * Set creado
     *
     * @param \DateTime $creado
     *
     * @return Colegiado
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
     * @return Colegiado
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
     * Add domicilio
     *
     * @param \AppBundle\Entity\Domicilio $domicilio
     *
     * @return Colegiado
     */
    public function addDomicilio(\AppBundle\Entity\Domicilio $domicilio)
    {
        $this->domicilios[] = $domicilio;

        return $this;
    }

    /**
     * Remove domicilio
     *
     * @param \AppBundle\Entity\Domicilio $domicilio
     */
    public function removeDomicilio(\AppBundle\Entity\Domicilio $domicilio)
    {
        $this->domicilios->removeElement($domicilio);
    }

    /**
     * Get domicilios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDomicilios()
    {
        return $this->domicilios;
    }

    /**
     * Add expediente
     *
     * @param \AppBundle\Entity\Expediente $expediente
     *
     * @return Colegiado
     */
    public function addExpediente(\AppBundle\Entity\Expediente $expediente)
    {
        $this->expedientes[] = $expediente;

        return $this;
    }

    /**
     * Remove expediente
     *
     * @param \AppBundle\Entity\Expediente $expediente
     */
    public function removeExpediente(\AppBundle\Entity\Expediente $expediente)
    {
        $this->expedientes->removeElement($expediente);
    }

    /**
     * Get expedientes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExpedientes()
    {
        return $this->expedientes;
    }

    /**
     * Set sexo
     *
     * @param \AppBundle\Entity\Sexo $sexo
     *
     * @return Colegiado
     */
    public function setSexo(\AppBundle\Entity\Sexo $sexo = null)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return \AppBundle\Entity\Sexo
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set tipoDocumento
     *
     * @param \AppBundle\Entity\TipoDocumento $tipoDocumento
     *
     * @return Colegiado
     */
    public function setTipoDocumento(\AppBundle\Entity\TipoDocumento $tipoDocumento = null)
    {
        $this->tipoDocumento = $tipoDocumento;

        return $this;
    }

    /**
     * Get tipoDocumento
     *
     * @return \AppBundle\Entity\TipoDocumento
     */
    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }

    /**
     * Set facultad
     *
     * @param \AppBundle\Entity\Facultad $facultad
     *
     * @return Colegiado
     */
    public function setFacultad(\AppBundle\Entity\Facultad $facultad = null)
    {
        $this->facultad = $facultad;

        return $this;
    }

    /**
     * Get facultad
     *
     * @return \AppBundle\Entity\Facultad
     */
    public function getFacultad()
    {
        return $this->facultad;
    }

    /**
     * Set circunscripcion
     *
     * @param \AppBundle\Entity\Circunscripcion $circunscripcion
     *
     * @return Colegiado
     */
    public function setCircunscripcion(\AppBundle\Entity\Circunscripcion $circunscripcion = null)
    {
        $this->circunscripcion = $circunscripcion;

        return $this;
    }

    /**
     * Get circunscripcion
     *
     * @return \AppBundle\Entity\Circunscripcion
     */
    public function getCircunscripcion()
    {
        return $this->circunscripcion;
    }

    /**
     * Set situacion
     *
     * @param \AppBundle\Entity\Situacion $situacion
     *
     * @return Colegiado
     */
    public function setSituacion(\AppBundle\Entity\Situacion $situacion = null)
    {
        $this->situacion = $situacion;

        return $this;
    }

    /**
     * Get situacion
     *
     * @return \AppBundle\Entity\Situacion
     */
    public function getSituacion()
    {
        return $this->situacion;
    }

    

    /**
     * Set creadoPor
     *
     * @param \UsuariosBundle\Entity\Usuario $creadoPor
     *
     * @return Colegiado
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
     * @return Colegiado
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
     * Set localidadNacimiento
     *
     * @param \UbicacionBundle\Entity\Localidad $localidadNacimiento
     *
     * @return Colegiado
     */
    public function setLocalidadNacimiento(\UbicacionBundle\Entity\Localidad $localidadNacimiento = null)
    {
        $this->localidadNacimiento = $localidadNacimiento;

        return $this;
    }

    /**
     * Get localidadNacimiento
     *
     * @return \UbicacionBundle\Entity\Localidad
     */
    public function getLocalidadNacimiento()
    {
        return $this->localidadNacimiento;
    }

    /**
     * Set localidad
     *
     * @param \UbicacionBundle\Entity\Localidad $localidad
     *
     * @return Colegiado
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
     * Set pathImagen
     *
     * @param string $pathImagen
     *
     * @return Colegiado
     */
    public function setPathImagen($pathImagen)
    {
        $this->pathImagen = $pathImagen;

        return $this;
    }

    /**
     * Get pathImagen
     *
     * @return string
     */
    public function getPathImagen()
    {
        return $this->pathImagen;
    }
}
