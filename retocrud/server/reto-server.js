const expressApp = require('express');
const enableCors = require('cors');
const resolvePath = require('path');

const servidor = expressApp();
const puerto = 5000;

const rutaArchivos = {
    root: resolvePath.join(__dirname, "public")
};

// Middlewares
servidor.use(enableCors());
servidor.use(expressApp.json());
servidor.use(expressApp.urlencoded({ extended: true }));
servidor.use(expressApp.static('public'));

// Conexión a MongoDB
const { MongoClient } = require('mongodb');
const cadenaConexion = 'mongodb+srv://usuarios:contraseña@cluster0.n0tkv.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0';
const conexion = new MongoClient(cadenaConexion);
const nombreBD = 'DataBaseAutomoviles';
const nombreColeccion = 'autos';

// Ruta de inicio
servidor.get('/home', (peticion, respuesta) => {
    respuesta.sendFile(resolvePath.join(__dirname, 'public', 'home.html'));
});

// Ruta para agregar vehículo
servidor.post('/insertar', async (peticion, respuesta) => {
    const datos = peticion.body;

    try {
        await conexion.connect();
        const db = conexion.db(nombreBD);
        const tabla = db.collection(nombreColeccion);

        await tabla.insertOne({
            id: datos.id,
            marca: datos.marca,
            modelo: datos.modelo,
            placa: datos.placa,
            color: datos.color,
            anio: datos.anio
        });

        respuesta.send(`
            <script>
                alert('Vehículo agregado correctamente');
                location.href = '/home';
            </script>
        `);
    } catch (err) {
        respuesta.status(500).send(`
            <script>
                alert('Error al guardar: ${err.message}');
                location.href = '/home';
            </script>
        `);
    } finally {
        await conexion.close();
    }
});

// Ruta para modificar color del vehículo
servidor.post('/actualizar', async (peticion, respuesta) => {
    const { id, color } = peticion.body;

    try {
        await conexion.connect();
        const db = conexion.db(nombreBD);
        const tabla = db.collection(nombreColeccion);

        const resultado = await tabla.updateOne({ id }, { $set: { color } });

        respuesta.send(`
            <script>
                alert('${resultado.matchedCount > 0 ? 'Actualización exitosa' : 'Vehículo no encontrado'}');
                location.href = '/home';
            </script>
        `);
    } catch (err) {
        respuesta.status(500).send(`
            <script>
                alert('Error al actualizar: ${err.message}');
                location.href = '/home';
            </script>
        `);
    } finally {
        await conexion.close();
    }
});

// Ruta para recuperar todos los vehículos
servidor.post('/recuperar', async (_req, res) => {
    try {
        await conexion.connect();
        const db = conexion.db(nombreBD);
        const tabla = db.collection(nombreColeccion);

        const registros = await tabla.find({}).toArray();
        res.json(registros);
    } catch (err) {
        res.status(500).json({ error: err.message });
    } finally {
        await conexion.close();
    }
});

// Ruta para eliminar vehículo por ID
servidor.post('/eliminar', async (peticion, respuesta) => {
    const { id } = peticion.body;

    try {
        await conexion.connect();
        const db = conexion.db(nombreBD);
        const tabla = db.collection(nombreColeccion);

        const resultado = await tabla.deleteOne({ id });

        respuesta.send(`
            <script>
                alert('${resultado.deletedCount > 0 ? 'Vehículo eliminado' : 'ID no encontrado'}');
                location.href = '/home';
            </script>
        `);
    } catch (err) {
        respuesta.status(500).send(`
            <script>
                alert('Error al eliminar: ${err.message}');
                location.href = '/home';
            </script>
        `);
    } finally {
        await conexion.close();
    }
});

// Lanzar el servidor
servidor.listen(puerto, () => {
    console.log(`Aplicación corriendo en: http://localhost:${puerto}`);
});