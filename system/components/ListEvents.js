// class CreditsPage extends React.Component {
//   render () {
//     return (
//       <div>
//         ?String?
//       </div>
//     )
//   }
// }

const { useEffect, useState } = React;

const ListEvents = (path) => {

  const [list, setList] = useState([]);
  useEffect(() => {
    fetch(path.path + 'listEventos.php')
      .then(res => res.json())
      .then(data => {
        //console.log("Datos recibidos:", data);
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
          <a href="javascript:void(0)">
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
