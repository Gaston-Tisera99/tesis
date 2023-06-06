<style>
    .bg{
        background-image: url(../img/portada.jpg);
        background-position: center center;
        background-size: cover;
    }

    body{
        background-color: #FDF5E6;
        background: linear-gradient(to right, #FFFFFF, #FDF5E6);
    }
</style>
        

<div class="container w-75 bg-light mt-5 rounded shadow">
        <div class="row align-items-stretch">
            <div class="col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded">

            </div>
            <div class="col bg-white p-4 rounded-end"> 
                <div class="col">
                    <div class="text-end">
                        <img src="../img/logo.jpg" width="48" alt="">  
                    </div>
                    <div class="text-center">
                        <h2 class="fw-bold py-5">Bienvenidos a <span class="text-danger fw-bold">MITO LIMPIEZAS</span></h2>
                        <p class="text-center">Inicia sesión como<span class="text-danger"> administrador</span></p>
                    </div>
                    
                </div>
                <form action="/" class="formulario" method="POST">
                    <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input 
                                type="email"
                                id="email"
                                placeholder="Tu Email"
                                name="email"
                                class="form-control"
                            />
                    </div>

                    <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input
                                type="password"
                                id="password"
                                placeholder="Tu Password"
                                name="password"
                                class="form-control"
                            />
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Iniciar Sesion</button>
                    </div>

                    <div class="my-3">
                        <a href="/crear-cuenta" class="d-inline me-2  text-dark">¿Aún no tienes cuenta? Crear Cuenta</a>
                        <a href="/olvide" class="d-inline  text-dark">¿Olvidaste tu password?</a>
                    </div>
                </form>
                
            </div>
        </div>
        
        
    </div>  