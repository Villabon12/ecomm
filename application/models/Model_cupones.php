<?php



defined('BASEPATH') or exit('No direct script access allowed');







class Model_cupones extends CI_Model
{

    //metodo contructor 

    function __construct()
    {

        parent::__construct();
    }


    public function slider_todo()
    {

        $sql = "SELECT c1.id,c1.nombre_negocio,c1.img_perfil, COUNT(c2.nombre) AS cupon 
        FROM master_usuarios c1,comercio_cupones c2 ,comercio_categoria c3
        WHERE c2.id_usuario=c1.id 
        AND c1.tipo='Comercio'
        AND img_perfil IS NOT NULL
        GROUP BY 1";
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function slider_todocate($id)
    {

        $sql = "SELECT c1.id,c1.nombre_negocio,c1.img_perfil, COUNT(c2.nombre) AS cupon 
        FROM master_usuarios c1,comercio_cupones c2 ,comercio_categoria c3
        WHERE c2.id_usuario=c1.id 
        AND c1.tipo='Comercio'
        AND img_perfil IS NOT NULL
        AND c2.id_categoria=?
        GROUP BY 1";
        $query = $this->db->query($sql, $id);
        return $query->result();
    }
    public function mas_vendido($id)
    {
        $sql = "SELECT c3.id, c2.producto,COUNT(c2.producto) cupon,c3.img,c3.precio
        FROM master_usuarios c1,comercio_wallet c2,comercio_cupones c3
        WHERE c2.id_usuario=c1.id
        AND c3.nombre=c2.producto
        AND c1.ciudad=?
        GROUP BY 1
        ORDER BY cupon DESC
        LIMIT 6
        ";
        $query = $this->db->query($sql, $id);
        return $query->result();
    }

    //landing
    public function productmoda()
    {
        $sql = "SELECT c1.*,c2.cashback FROM comercio_cupones c1,comercio_parametros c2 WHERE c1.id_categoria=5 AND c1.img IS NOT NULL AND c2.id=1 ORDER BY RAND() LIMIT 4";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function productvacation()
    {
        $sql = "SELECT DISTINCT  c1.*FROM comercio_cupones c1  WHERE c1.id_categoria=19 OR c1.id_categoria=20 OR c1.id_categoria=22";
        $query = $this->db->query($sql);
        return $query->result();
    }

    ///nueva land´
    //landing
    public function moda()
    {
        $sql = "SELECT c2.nombre_negocio,c1.*,c3.cashback FROM comercio_cupones c1,master_usuarios c2 ,comercio_parametros c3 
     WHERE c1.id_usuario=c2.id AND c3.id=1 AND c1.id_categoria=5 AND c1.activo=1 AND c1.img IS NOT NULL ORDER BY RAND() LIMIT 8";
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function vacation()
    {
        $sql = "SELECT c2.nombre_negocio, c1.*,c3.cashback  FROM comercio_cupones c1,master_usuarios c2,comercio_parametros c3
     WHERE c1.id_usuario=c2.id  AND c3.id=1 AND c1.id_categoria=19 AND c1.activo=1 AND c1.img IS NOT NULL
     UNION
      SELECT c2.nombre_negocio, c1.*,c3.cashback  FROM comercio_cupones c1,master_usuarios c2,comercio_parametros c3
     WHERE c1.id_usuario=c2.id AND c3.id=1 AND c1.id_categoria=20 AND c1.activo=1 AND c1.img IS NOT NULL 
     ORDER BY RAND() LIMIT 8        
     ";
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function comida()
    {
        $sql = "SELECT c2.nombre_negocio, c1.*,c3.cashback FROM comercio_cupones c1,master_usuarios c2 ,comercio_parametros c3 
     WHERE c1.id_usuario=c2.id AND c3.id=1 AND c1.id_categoria=4 AND c1.activo=1 AND c1.img IS NOT NULL   ORDER BY RAND() LIMIT 8  ";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function salud()
    {
        $sql = "SELECT c2.nombre_negocio,c1.*,c3.cashback FROM comercio_cupones c1,master_usuarios c2 ,comercio_parametros c3 
     WHERE c1.id_usuario=c2.id AND c3.id=1 AND c1.id_categoria=18  AND c1.activo=1 AND c1.img IS NOT NULL ORDER BY RAND() LIMIT 8";
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function electro()
    {
        $sql = "SELECT c2.nombre_negocio, c1.*,c3.cashback  FROM comercio_cupones c1,master_usuarios c2,comercio_parametros c3
     WHERE c1.id_usuario=c2.id  AND c3.id=1 AND c1.id_categoria=2 AND c1.activo=1 AND c1.img IS NOT NULL
     UNION
     SELECT c2.nombre_negocio, c1.*,c3.cashback  FROM comercio_cupones c1,master_usuarios c2,comercio_parametros c3
     WHERE c1.id_usuario=c2.id AND c3.id=1 AND c1.id_categoria=14 AND c1.activo=1 AND c1.img IS NOT NULL 
     ORDER BY RAND() LIMIT 8";
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function traerCategorias()
    {
        $sql = "SELECT c1.id, c1.nombre,c1.img, COUNT(c2.nombre) cupon
      FROM comercio_categoria c1,comercio_cupones c2
      WHERE c2.id_categoria=c1.id
      GROUP BY 1 ";
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function todito()
    {
        $sql = "SELECT c1.*, c2.nombre_negocio,c3.cashback,c4.id AS id_tipo, c4.nombre AS tipo,c2.id AS id_comercio
      FROM comercio_cupones c1,master_usuarios c2,comercio_parametros c3 ,comercio_tipos c4
      WHERE c1.id_usuario=c2.id
      AND c1.activo=1
      AND c3.id=1
      AND c1.id_tipo=c4.id
      AND c1.stok>0";
        $query = $this->db->query($sql);
        return $query->result();
    }
    ///Funcionalidad interna
    public function todo_ciudad($ciudad)
    {
        $traer = 'SELECT c1.*, c2.nombre_negocio,c3.cashback,c4.id AS id_tipo, c4.nombre AS tipo,c2.id AS id_comercio
		FROM comercio_cupones c1,master_usuarios c2,comercio_parametros c3 ,comercio_tipos c4
		WHERE c1.id_usuario=c2.id
		AND c1.activo=1
		AND c3.id=1
		AND c1.id_tipo=c4.id    
		AND c1.stok>0
		AND c2.ciudad=?
		UNION
		ORDER BY RAND();';
        $query = $this->db->query($traer, array($ciudad, $ciudad));
        return $query->result();
    }
    public function modaint($ciudad)
    {
        $sql = "SELECT c1.*, c2.nombre_negocio,c3.cashback,c4.id AS id_tipo, c4.nombre AS tipo,c2.id AS id_comercio
		FROM comercio_cupones c1,master_usuarios c2,comercio_parametros c3 ,comercio_tipos c4
		WHERE c1.id_usuario=c2.id
		AND c1.activo=1
		AND c3.id=1
		AND c1.id_tipo=c4.id
		AND c1.id_categoria=5
		AND c1.stok>0
		AND c2.ciudad=?
		UNION
		SELECT c1.*, c2.nombre_negocio,c3.cashback ,c4.id AS id_tipo, c4.nombre AS tipo,c2.id AS id_comercio
		FROM comercio_cupones c1,master_usuarios c2,comercio_parametros c3,comercio_tipos c4
		WHERE c1.id_usuario=c2.id
		AND c1.activo=1
		AND c3.id=1
		AND c1.stok>0
		AND c1.id_categoria=5
		AND c1.id_tipo=c4.id
		AND c2.ciudad!=?
		AND c1.envio_nacio=1
		ORDER BY RAND()
		LIMIT 8;";
        $query = $this->db->query($sql,array($ciudad,$ciudad));
        return $query->result();
    }
    public function vacationint()
    {
        $sql = "SELECT c1.*, c2.nombre_negocio,c3.cashback,c4.id AS id_tipo, c4.nombre AS tipo,c2.id AS id_comercio
		FROM comercio_cupones c1,master_usuarios c2,comercio_parametros c3 ,comercio_tipos c4
		WHERE c1.id_usuario=c2.id
		AND c1.activo=1
		AND c3.id=1
		AND c1.id_tipo=c4.id
		AND c1.id_categoria=20
		AND c1.stok>0
        ORDER BY RAND()
		LIMIT 8";
        $query = $this->db->query($sql);
        return $query->result();
    }
    public function comidaint($ciudad)
    {
        $sql = "SELECT c1.*, c2.nombre_negocio,c3.cashback,c4.id AS id_tipo, c4.nombre AS tipo,c2.id AS id_comercio
		FROM comercio_cupones c1,master_usuarios c2,comercio_parametros c3 ,comercio_tipos c4
		WHERE c1.id_usuario=c2.id
		AND c1.activo=1
		AND c3.id=1
		AND c1.id_tipo=c4.id
		AND c1.id_categoria=4
		AND c1.stok>0
		AND c2.ciudad=?
		UNION
		SELECT c1.*, c2.nombre_negocio,c3.cashback ,c4.id AS id_tipo, c4.nombre AS tipo,c2.id AS id_comercio
		FROM comercio_cupones c1,master_usuarios c2,comercio_parametros c3,comercio_tipos c4
		WHERE c1.id_usuario=c2.id
		AND c1.activo=1
		AND c3.id=1
		AND c1.stok>0
		AND c1.id_categoria=4
		AND c1.id_tipo=c4.id
		AND c2.ciudad!=?
		AND c1.envio_nacio=1
		ORDER BY RAND()
		LIMIT 8;";
        $query = $this->db->query($sql, array($ciudad, $ciudad));
        return $query->result();
    }

    public function saludint($ciudad)
    {
        $sql = "SELECT c1.*, c2.nombre_negocio,c3.cashback,c4.id AS id_tipo, c4.nombre AS tipo,c2.id AS id_comercio
		FROM comercio_cupones c1,master_usuarios c2,comercio_parametros c3 ,comercio_tipos c4
		WHERE c1.id_usuario=c2.id
		AND c1.activo=1
		AND c3.id=1
		AND c1.id_tipo=c4.id
		AND c1.id_categoria=18
		AND c1.stok>0
		AND c2.ciudad=?
		UNION
		SELECT c1.*, c2.nombre_negocio,c3.cashback ,c4.id AS id_tipo, c4.nombre AS tipo,c2.id AS id_comercio
		FROM comercio_cupones c1,master_usuarios c2,comercio_parametros c3,comercio_tipos c4
		WHERE c1.id_usuario=c2.id
		AND c1.activo=1
		AND c3.id=1
		AND c1.stok>0
		AND c1.id_categoria=18
		AND c1.id_tipo=c4.id
		AND c2.ciudad!=?
		AND c1.envio_nacio=1
		ORDER BY RAND()
		LIMIT 8;";
        $query = $this->db->query($sql, array($ciudad, $ciudad));
        return $query->result();
    }
    public function electroint($ciudad)
    {
        $sql = "SELECT c1.*, c2.nombre_negocio,c3.cashback,c4.id AS id_tipo, c4.nombre AS tipo,c2.id AS id_comercio
		FROM comercio_cupones c1,master_usuarios c2,comercio_parametros c3 ,comercio_tipos c4
		WHERE c1.id_usuario=c2.id
		AND c1.activo=1
		AND c3.id=1
		AND c1.id_tipo=c4.id
		AND c1.id_categoria=14
		AND c1.stok>0
		AND c2.ciudad=?
		UNION
		SELECT c1.*, c2.nombre_negocio,c3.cashback ,c4.id AS id_tipo, c4.nombre AS tipo,c2.id AS id_comercio
		FROM comercio_cupones c1,master_usuarios c2,comercio_parametros c3,comercio_tipos c4
		WHERE c1.id_usuario=c2.id
		AND c1.activo=1
		AND c3.id=1
		AND c1.stok>0
		AND c1.id_categoria=14
		AND c1.id_tipo=c4.id
		AND c2.ciudad!=?
		AND c1.envio_nacio=1
		ORDER BY RAND()
		LIMIT 8;";
        $query = $this->db->query($sql, array($ciudad, $ciudad));
        return $query->result();
    }
}