DELIMITER $$

CREATE PROCEDURE sp_create_project(
    IN p_client_id     BIGINT,
    IN p_artisan_id    BIGINT,
    IN p_title         VARCHAR(255),
    IN p_description   TEXT,
    IN p_price         DECIMAL(10,2)
)
BEGIN
    DECLARE v_client_exists   INT DEFAULT 0;
    DECLARE v_artisan_exists  INT DEFAULT 0;
    DECLARE v_project_id      BIGINT;

    -- Manejo de errores global
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;
        RESIGNAL SET MESSAGE_TEXT = 'Error inesperado al crear el proyecto.';
    END;

    -- Iniciar transacción
    START TRANSACTION;

    -- === VALIDAR QUE EXISTE EL CLIENTE ===
    SELECT COUNT(*) INTO v_client_exists
    FROM clients 
    WHERE id = p_client_id;

    IF v_client_exists = 0 THEN
        ROLLBACK;
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'El cliente no existe. Verifica tu perfil.';
    END IF;

    -- === VALIDAR QUE EXISTE EL ARTESANO ===
    SELECT COUNT(*) INTO v_artisan_exists
    FROM artisans 
    WHERE id = p_artisan_id;

    IF v_artisan_exists = 0 THEN
        ROLLBACK;
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'El artesano no existe. Verifica tu perfil.';
    END IF;

    -- === VALIDAR TÍTULO ===
    IF p_title IS NULL OR TRIM(p_title) = '' THEN
        ROLLBACK;
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'El título del proyecto es obligatorio.';
    END IF;

    -- === VALIDAR DESCRIPCIÓN ===
    IF p_description IS NULL OR TRIM(p_description) = '' THEN
        ROLLBACK;
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'La descripción del proyecto es obligatoria.';
    END IF;

    -- === INSERTAR PROYECTO ===
    INSERT INTO projects (
        client_id,
        artisan_id,
        title,
        description,
        price,
        status,
        created_at,
        updated_at
    ) VALUES (
        p_client_id,
        p_artisan_id,
        p_title,
        p_description,
        p_price,
        'pending',
        NOW(),
        NOW()
    );

    -- Obtener ID del proyecto creado
    SET v_project_id = LAST_INSERT_ID();

    -- Confirmar transacción
    COMMIT;

    -- === RESPUESTA EXITOSA ===
    SELECT 
        'success' AS status,
        'Proyecto creado con éxito' AS message,
        v_project_id AS project_id,
        p_title AS title,
        p_price AS price;

END$$

DELIMITER ;