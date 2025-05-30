const { useEffect, useState } = React;

const ListEvents = (path) => {

  const [list, setList] = useState([]);
  const reedNotifications = (id) => {
    alert('Mostrar Evento/Notificacion id: ' + id)
  }
  useEffect(() => {
    fetch(path.path + 'listEventos.php')
      .then(res => res.json())
      .then(data => {
        setList(data);
      }
        );
  }, []);
  return (
    <div>
    <ul>
    {Array.isArray(list.result) && list.result.length > 0 ? (
      list.result.map(data => (
        <li>
          <a href="javascript:void(0)" onClick={()=>{reedNotifications(data.id)}}>
            <span class="label label-success"><i class="fa fa-comment"></i></span>
            <span class="message"> {data.name}</span>
          </a>
        </li>
      )
    )
    ) : (
      <p>Cargando o sin notificaciones...</p>
    )}
    </ul>
  </div>
  );
}
