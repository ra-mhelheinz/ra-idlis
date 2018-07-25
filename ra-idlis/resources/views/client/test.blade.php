
@php
for ($i=0; $i < count($request->upID); $i++) {
	echo 'file:'.$request->file[$i].'<br>remark:'.$request->remarks[$i].'<br>complied:'.$request->complied[$request->upID[$i]].'<br>';
}
@endphp