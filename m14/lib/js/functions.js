const templater = (fn) => (oa) =>
	(Array.isArray(oa)?oa:[oa])
	.reduce((r,o,i,a)=>r+fn(o,i,a),"");





const getData = (type,options) => {

	let fd = new FormData();
	for(let i in options)
		fd.append(i,options[i]);

	return fetch(
		`data/api.php?type=${type}`,
		{
			method:'POST',
			body:fd
		}
		)
	.then(d=>d.json());
}