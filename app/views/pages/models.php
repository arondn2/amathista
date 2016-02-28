(:: parent:views/docs.php :)
(:: set:pageTitle='Modelos' :)

<p>
  Los modelos son abstracciones de la información manejada por lo general gestionada a través de un Sistema Manejador de Base de datos (SMDB). Los modelos permiten buscar agregar, buscar, actualizar y eliminar registros de las tablas de las base de datos configuradas. También permite la realización
  de consulta complejas de una forma sencilla y entendible, creación e eliminación de tablas, vistas y base de datos, entre otros. Todas estas acciones son logradas a través del Mapeo Objeto-Relación (ORM por sus siglas en inglés) propio de Amathista.
</p>

<div>
  <h2>Configuración</h2>

  <p>
    La utilización del ORM comienza con la configuración de las conexiones a las BDs mendiante la propiedad de aplicación <code><strong>schemes</strong></code> la cual es un hash donde cada clave representa el nombre de una conexión y su valor la confuiguración de conexión.
  </p>

  <div class="divide-section">
    <table>
      <tr>
        <td class="s6">
          <pre><code class="language-php">(:= getCodeFile('models/schemes.conf.php') :)</code></pre>
        </td>
        <td class="s6">
          <pre><code class="language-php">(:= getCodeFile('models/am.conf.php') :)</code></pre>
        </td>
      </tr>
    </table>
  </div>

</div>

<div>
  <h2>Propiedades</h2>

  <p>
    Las propiedades para configurar la conexión son:
  </p>

  <table class="table striped">
    <thead>
      <tr>
        <th>Propiedad</th>
        <th>Tipo</th>
        <th>Descripción</th>
        <th>Ejemplo</th>
      </tr>
    </thead>
    <tbody class="text-left">
      <tr>
        <td><code><strong>driver</strong></code></td>
        <td><code><strong>string</strong></code></td>
        <td>
          Driver con el que se conectará a la base de datos. Actualmente solo se cuenta con conexión a MySQL.
        </td>
        <td><pre class="table-pre"><code class="language-php">'driver' => 'mysql'</code></pre></td>
      </tr>
      <tr>
        <td><code><strong>database</strong></code></td>
        <td><code><strong>string</strong></code></td>
        <td>
          Nombre de la base de datos a la que se conectará.
        </td>
        <td><pre class="table-pre"><code class="language-php">'database' => 'foo'</code></pre></td>
      </tr>
      <tr>
        <td><code><strong>server</strong></code></td>
        <td><code><strong>string</strong></code></td>
        <td>
          Nombre o dirección del servidor de base de datos al que se conetará.
        </td>
        <td><pre class="table-pre"><code class="language-php">'server' => 'localhost'</code></pre></td>
      </tr>
      <tr>
        <td><code><strong>port</strong></code></td>
        <td><code><strong>int</strong></code></td>
        <td>
          Número del puerto para la conexión.
        </td>
        <td><pre class="table-pre"><code class="language-php">'port' => 3306</code></pre></td>
      </tr>
      <tr>
        <td><code><strong>user</strong></code></td>
        <td><code><strong>string</strong></code></td>
        <td>
          Usuario para la conexión.
        </td>
        <td><pre class="table-pre"><code class="language-php">'user' => 'bar'</code></pre></td>
      </tr>
      <tr>
        <td><code><strong>pass</strong></code></td>
        <td><code><strong>string</strong></code></td>
        <td>
          Password del usario para la conexión.
        </td>
        <td><pre class="table-pre"><code class="language-php">'pass' => 'passsword'</code></pre></td>
      </tr>
      <tr>
        <td><code><strong>charset</strong></code></td>
        <td><code><strong>string</strong></code></td>
        <td>
          Set de caracteres de la basa de datos.
        </td>
        <td><pre class="table-pre"><code class="language-php">'charset' => 'utf8'</code></pre></td>
      </tr>
      <tr>
        <td><code><strong>collation</strong></code></td>
        <td><code><strong>string</strong></code></td>
        <td>
          Reglas de caracteres de la basa de datos.
        </td>
        <td><pre class="table-pre"><code class="language-php">'collation' => 'utf8_unicode_ci'</code></pre></td>
      </tr>
    </tbody>
  </table>

</div>

<div>
  <h3></h3>


</div>

<div>
  <h2>Definición de modelo</h2>
  
  <p>
    Los modelos se implementan extendiendo de la clase <code><strong>AmModel</strong></code>. Por defecto los modelos son buscados dentro del directorio <code><strong>/app/models/</strong></code>. Un ejemplo de definir un modelo sería el siguiente:
  </p>

  <pre><code class="language-php">(:= getCodeFile('models/Person.class.php') :)</code></pre>

  <div>
    <h3>Nombre de tabla</h3>
    
    <p>
      Para indicar el nombre de la tabla se utiliza el atributo <code><strong>$tableName</strong></code>. Si no se define se tomá como nombre de tabla el nombre de la clase en plurar según la gramática inglesa.
    </p>
    <pre><code class="language-php">(:= getCodeFile('models/Person.tableName.class.php') :)</code></pre>

  </div>

  <div>
    <h3>Nombre de esquema</h3>
    
    <p>
      El nombre del esquema al que pertenece el modelo se define mediante el atributo <code><strong>$schemeName</strong></code>. Si no es indicado o si es un string vacío, el modelo pertenecerá al esquema por defecto.
    </p>
    <pre><code class="language-php">(:= getCodeFile('models/Person.schemeName.class.php') :)</code></pre>

  </div>

  <div>
    <h3>Campos</h3>

    <p>
      Hash de campos y su descripción. Para definirlos se utiliza el atributo <code><strong>$fields</strong></code>.
    </p>

    <div>
      <h4>Propiedades de los campos</h4>

      <p>
        Los campos poseen otras características que pueden ser modificadas:
      </p>

      <table class="table striped">
        <thead>
          <tr>
            <th>Propiedad</th>
            <th>Tipo</th>
            <th>Descripción</th>
            <th>Valor por defecto</th>
            </tr>
        </thead>
        <tbody class="text-left">
          <tr>
            <td><code><strong>type</strong></code></td>
            <td><code><strong>string</strong></code></td>
            <td>Tipo de datos para campo</td>
            <td><pre class="table-pre"><code class="language-php">'type' => 'text'</code></pre></td>
          </tr>
          <tr>
            <td><code><strong>defaultValue</strong></code></td>
            <td><code><strong>mixed</strong></code></td>
            <td>Valor por defecto que tomará el campo.</td>
            <td><pre class="table-pre"><code class="language-php">'defaultValue' => null</code></pre></td></td>
          </tr>
          <tr>
            <td><code><strong>pk</strong></code></td>
            <td><code><strong>bool</strong></code></td>
            <td>Si el campo forma parte de la clave primaria del modelo</td>
            <td><pre class="table-pre"><code class="language-php">'pk' => false</code></pre></td></td>
          </tr>
          <tr>
            <td><code><strong>allowNull</strong></code></td>
            <td><code><strong>bool</strong></code></td>
            <td>Si permite valores nulos</td>
            <td><pre class="table-pre"><code class="language-php">'allowNull' => true</code></pre></td></td>
          </tr>
          <tr>
            <td><code><strong>len</strong></code></td>
            <td><code><strong>int</strong></code></td>
            <td>Longuitud del campo. En campos del tipo <code><strong>int</strong></code>, <code><strong>float</strong></code> y <code><strong>text</strong></code> representa el tamaño del campo y en campos de texto del tipo <code><strong>char</strong></code>, <code><strong>varchar</strong></code> y <code><strong>bit</strong></code></td> representa la longuitud en caracteres.
            <td><pre class="table-pre"><code class="language-php">'len' => null</code></pre></td></td>
          </tr>
          <tr>
            <td><code><strong>charset</strong></code></td>
            <td><code><strong>string</strong></code></td>
            <td>Set de caracteres. Solo se toma en cuenta en campos de texto (<code><strong>char</strong></code>, <code><strong>varchar</strong></code> y <code><strong>text</strong></code></td>
            <td><pre class="table-pre"><code class="language-php">'charset' => null</code></pre></td></td>
          </tr>
          <tr>
            <td><code><strong>collation</strong></code></td>
            <td><code><strong>string</strong></code></td>
            <td>Coleción de reglas de caracteres. Solo se toma en cuenta en campos de texto (<code><strong>char</strong></code>, <code><strong>varchar</strong></code> y <code><strong>text</strong></code></td>
            <td><pre class="table-pre"><code class="language-php">'collation' => null</code></pre></td></td>
          </tr>
          <tr>
            <td><code><strong>unsigned</strong></code></td>
            <td><code><strong>bool</strong></code></td>
            <td>Si solo admite valores numéricos positivos. Solo se toma en cuenta en campos numéricos (<code><strong>int</strong></code> y <code><strong>float</strong></code>)</td>
            <td><pre class="table-pre"><code class="language-php">'unsigned' => null</code></pre></td></td>
          </tr>
          <tr>
            <td><code><strong>zerofill</strong></code></td>
            <td><code><strong>bool</strong></code></td>
            <td>Si se completan con ceros. Solo se toma en cuenta en campos numéricos (<code><strong>int</strong></code> y <code><strong>float</strong></code>)</td>
            <td><pre class="table-pre"><code class="language-php">'zerofill' => null</code></pre></td></td>
          </tr>
          <tr>
            <td><code><strong>precision</strong></code></td>
            <td><code><strong>int</strong></code></td>
            <td>Cantidad de dígitos de la parte entera. Solo se toma en cuenta en campos del tipo <code><strong>float</strong></code>.</td>
            <td><pre class="table-pre"><code class="language-php">'precision' => null</code></pre></td></td>
          </tr>
          <tr>
            <td><code><strong>scale</strong></code></td>
            <td><code><strong>int</strong></code></td>
            <td>Cantidad de dígitos de la parte decimal. Solo se toma en cuenta en campos del tipo <code><strong>float</strong></code>.</td>
            <td><pre class="table-pre"><code class="language-php">'scale' => null</code></pre></td></td>
          </tr>
          <tr>
            <td><code><strong>autoIncrement</strong></code></td>
            <td><code><strong>bool</strong></code></td>
            <td>Si es un campo autoincrementable. Solo se toma en cuenta en campos numéricos (<code><strong>int</strong></code> y <code><strong>float</strong></code>)</td>
            <td><pre class="table-pre"><code class="language-php">'autoIncrement' => false</code></pre></td></td>
          </tr>
          <tr>
            <td><code><strong>extra</strong></code></td>
            <td><code><strong>string</strong></code></td>
            <td>Configuraciones extras.</td>
            <td><pre class="table-pre"><code class="language-php">'extra' => null</code></pre></td></td>
          </tr>
        </tbody>
      </table>

    </div>

    <div>
      <h4>Tipos de campos básicos</h4>
      
      <p>
        Los diferentes tipos de campos que pueden ser asignados a la propiedad <code><strong>type</strong></code> de los campos:
      </p>

      <div class="divide-section">
        <div class="col c6 sect">
          <table class="table striped">
            <thead>
              <tr>
                <th>Tipo de campo</th>
                <th>Descripción</th>
              </tr>
            </thead>
            <tbody class="text-left">
              <tr>
                <td><code><strong>int</strong></code></td>
                <td>Tipos de datos enteros</td>
              </tr>
              <tr>
                <td><code><strong>float</strong></code></td>
                <td>Números punto flotantes.</td>
              </tr>
              <tr>
                <td><code><strong>date</strong></code></td>
                <td>Fechas.</td>
              </tr>
              <tr>
                <td><code><strong>datetime</strong></code></td>
                <td>Fecha y hora.</td>
              </tr>
              <tr>
                <td><code><strong>timestamp</strong></code></td>
                <td>Fecha y hora (menor rango).</td>
              </tr>
              <tr>
                <td><code><strong>time</strong></code></td>
                <td>Hora.</td>
              </tr>
              <tr>
                <td><code><strong>char</strong></code></td>
                <td>Cadena de caracteres de longuitud constante.</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col c6 sect">
          <table class="table striped">
            <thead>
              <tr>
                <th>Tipo de campo</th>
                <th>Descripción</th>
              </tr>
            </thead>
            <tbody class="text-left">
              <tr>
                <td><code><strong>varchar</strong></code></td>
                <td>Cadena de caracteres de longuitud variable.</td>
              </tr>
              <tr>
                <td><code><strong>text</strong></code></td>
                <td>Cadena de caracteres larga.</td>
              </tr>
              <tr>
                <td><code><strong>year</strong></code></td>
                <td>Entero que representa un año.</td>
              </tr>
              <tr>
                <td><code><strong>bit</strong></code></td>
                <td>Cadena de bits.</td>
              </tr>
              <tr>
                <td><code><strong>id</strong></code></td>
                <td>Campo enter sin signo que forma parte de la clave primaria del modelo.</td>
              </tr>
              <tr>
                <td><code><strong>autoIncrement</strong></code></td>
                <td>Campo enter sin signo.</td>
              </tr>
              <tr>
                <td><code><strong>unsigned</strong></code></td>
                <td>Campo entero sin signo.</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>

    <p>
      Ejemplos:
    </p>
    <pre><code class="language-php">(:= getCodeFile('models/Person.fields.class.php') :)</code></pre>

  </div>

  <div>
    <h3>Clave primaria</h3>

    <p>
      Nombre el campo o lista de los nombres de los campos que forman la clave primaria del modelo. Se define mediante el atributo <code><strong>$pks</strong></code>. Tenga en cuenta que si algún campo es marcado como campo primario dentro de la propiedad <code><strong>$fields</strong></code> este tambien será parte de la clave primaria incluso si no se señala dentro de esta propiedad.
    </p>

    <div class="divide-section">
      <table>
        <tr>
          <td class="s6">
            <pre><code class="language-php">(:= getCodeFile('models/Person.pks.class.php') :)</code></pre>
          </td>
          <td class="s6">
            <pre><code class="language-php">(:= getCodeFile('models/InvoiceDetail.pks.class.php') :)</code></pre>
          </td>
        </tr>
      </table>
    </div>

  </div>

  <div>
    <h3>Campo de fecha de creación y modificación</h3>
  
    <p>
      Para indicar o crear los campos de fechas de creación y modificación de un modelo utilice los atributos <code><strong>createdAtField</strong></code> y <code><strong>updatedAtField</strong></code> respectivamente.
      Estos modelos añaden campos del tipo <code><strong>timestamp</strong></code> con los nombres <code><strong>created_at</strong></code> y <code><strong>updated_at</strong></code> que son asignados automáticamente. Para utiliza nombres de campos diferentes asigne al atributo el nombre del campo.
    </p>

    <div class="divide-section">
      <table>
        <tr>
          <td class="s6">
            <pre><code class="language-php">(:= getCodeFile('models/Person.createdAndUpdatedField.class.php') :)</code></pre>
          </td>
          <td class="s6">
            <pre><code class="language-php">(:= getCodeFile('models/Person.customCreatedAndUpdatedField.class.php') :)</code></pre>
          </td>
        </tr>
      </table>
    </div>
    
  </div>
<!-- 
  <div>
    <h3>Relaciones</h3>

    <p>
      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse repellendus unde, obcaecati tenetur quidem expedita corporis natus odio, accusamus quos atque aut earum. Pariatur ducimus, velit nulla praesentium sapiente iusto!
    </p>

  </div>

  <div>
    <h3>Uniques</h3>

    <p>
      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse repellendus unde, obcaecati tenetur quidem expedita corporis natus odio, accusamus quos atque aut earum. Pariatur ducimus, velit nulla praesentium sapiente iusto!
    </p>

  </div>

  <div>
    <h3>Validators</h3>

    <p>
      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse repellendus unde, obcaecati tenetur quidem expedita corporis natus odio, accusamus quos atque aut earum. Pariatur ducimus, velit nulla praesentium sapiente iusto!
    </p>

  </div> -->

</div>