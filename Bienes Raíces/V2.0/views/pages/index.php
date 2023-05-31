<main class="contenedor todo">
    <h2 class="contenedor_index-h2">Más sobre nosotros</h2>
    <div class="iconos-nosotros">
        <?php include __DIR__ . './icons.php'?>
    </div>
</main>

<section class ="seccion contenedor">
    <h2>Casas y Departamentos en Venta</h2>
    <?php
        include __DIR__ . './listado.php';
    ?>
        </div><!-- Contenedor de anuncios -->
        <div class="alinear-derecha">
            <a href="/anuncios" class="boton-verde">Ver Todas</a>
        </div>

</section>

<section class="imagen-contacto">
    <h2>Encuentra la casa de tus sueños</h2>
    <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo de inmediato</p>
    <a href="/contacto" class="boton-amarillo-inblock">Contáctanos</a>
</section>

<div class="contenedor seccion seccion-inferior">
    <section class="blog">
        <h3>Nuestro Blog</h3>
        
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog1.webp" type="image/webp">
                    <source srcset="build/img/blog1.jpg" type="image/jpg">
                    <img loading="lazy" src="build/img/blog1.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="/entrada">
                    <h4>Terraza en el techo de tu casa</h4>
                    <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>

                    <p>
                        Consejos para construir una terraza en el techo de tu casa con los mejores
                        materiales y ahorrando dinero
                    </p>
                </a>
            </div>
        </article>

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog2.webp" type="image/webp">
                    <source srcset="build/img/blog2.jpg" type="image/jpg">
                    <img loading="lazy" src="build/img/blog2.jpg" alt="Texto Entrada Blog">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="/entrada">
                    <h4>Guía para la decoración de tu hogar</h4>
                    <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>

                    <p>
                        Maximiza el espacio en tu hogar con esta guía, aprende a combinar muebles y 
                        colores para darle vida a tu espacio
                    </p>
                </a>
            </div>
        </article>

    </section>
    <section class="testimoniales">
        <h3>Testimoniales</h3>

        <div class="testimonial">
            <blockquote>
                El personal se comportó de una excelente forma, muy buena atención y la casa que me 
                ofrecieron cumple con todas mis expectativas.
            </blockquote>
            <p>- Danilo Iván Alanis Rocha</p>
        </div>
    </section>
</div>