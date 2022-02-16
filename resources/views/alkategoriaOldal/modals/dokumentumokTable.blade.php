<table>
    <tr>
        <th>Név</th>
        <th>Eredeti fájlnév</th>
        <th>Verziószám</th>
        <th>Feltöltés időpontja</th>
        <th>Feltöltő felhasználó</th>
        @if ($jogosultsagok->jogosultsagLetT == 1)
            <th>Fájl letöltés</th>
        @endif
        @if ($jogosultsagok->jogosultsagFelT == 1)
            <th>Fájl törlése</th>
        @endif
    </tr>

    @for ($i = 0; $i < count($hozzaTartozoFileNevek); $i++)
        <tr>
            <td>{{$hozzaTartozoFileNevek[$i]->nev}}</td>
            <td>{{$hozzaTartozoFileNevek[$i]->eredeti_fajlnev}}</td>
            <td>{{$hozzaTartozoFileNevek[$i]->verzioszam}}</td>
            <td>{{$hozzaTartozoFileNevek[$i]->feltoltes_idopontja}}</td>
            <td>{{$hozzaTartozoFileNevek[$i]->feltolto_felhasznalo}}</td>
            
            @if ($jogosultsagok->jogosultsagLetT == 1)
            <td>
                <button type="button">
                    <a href="/fajlok/{{$fokategoriaNeve}}/{{$alKategoriaNev}}/{{$hozzaTartozoFileNevek[$i]->eredeti_fajlnev}}">
                        <img src="/ikonok/download.png" alt="Letöltés" class="download">
                    </a>
                </button></td>
            @endif

            @if ($jogosultsagok->jogosultsagFelT == 1)
            <td>
                <button type="button"
                id="{{$hozzaTartozoFileNevek[$i]->id}}" 
                name="{{$alKategoria}}"
                data-bs-toggle="modal"
                data-bs-target="#deletFile"
                onclick="deleteFile(this)">
                <img src="/ikonok/kuka.png" alt="Törlés" class="deletTrash"></button></td>
            @endif
        </tr>
    @endfor
</table>