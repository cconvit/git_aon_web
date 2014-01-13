<form action="operation.php" method="post">
  <div style="width: 870px; overflow-x: auto;">
    <table id="vehicle-suggestion">
      <thead>
      <th>Marca</th>
      <th>Modelo</th>
      <th>Versión</th>
      <th>Año</th>
      <th>Inma</th>
      <th>Cobertura</th>
      <th>Uso</th>
      <th>Ocupantes</th>
      <th>Edad</th>
      <th>Sexo</th>
      <th class="no-border">Edo. Civil</th>
      </thead>
      <tbody>
        <tr>
          <td>
            <ul id="marca" class="vehicle-suggestion-list" role="marca" data="unselected">
              <li><span class="icon-mini icon-clear img-common icon-error"></span>TOTAL</li>
              <li data="1"><span class="icon-mini icon-clear"></span>ACURA</li>
              <li><input name="marca" type="hidden"></li>
            </ul>
          </td>
          <td>
            <ul id="modelo" class="vehicle-suggestion-list" role="modelo" data="unselected">
              <li>No hay modelos</li>
            </ul>
          </td>
          <td>
            <ul id="version" class="vehicle-suggestion-list" role="version" data="unselected">
              <li>No hay versiones</li>
            </ul>
          </td>
          <td>
            <ul id="ano" class="vehicle-suggestion-list" role="ano" data="unselected">
              <li>No hay años</li>
            </ul>
          </td>
          <td>
            <ul id="inma" class="vehicle-suggestion-list" role="inma" data="unselected">
              <li>No hay inma</li>
            </ul>
          </td>
          <td>
            <ul class="vehicle-suggestion-list" role="cobertura" data="selected">
              <li role="selected"><span class="icon-mini icon-clear img-common icon-selected"></span>TOTAL</li>
              <li><span class="icon-mini icon-clear"></span>AMPLIA</li>
              <li><span class="icon-mini icon-clear"></span>RCV</li>
              <li><input name="cobertura" type="hidden" value="1"></li>
            </ul>
          </td>
          <td>
            <ul class="vehicle-suggestion-list" role="uso" data="selected">
              <li role="selected"><span class="icon-mini icon-clear img-common icon-selected"></span>PARTICULAR</li>
              <li><span class="icon-mini icon-clear"></span>RÚSTICO</li>
              <li><span class="icon-mini icon-clear"></span>PICKUP/VAN</li>
              <li><input name="uso" type="hidden" value="1"></li>
            </ul>
          </td>
          <td>
            <ul class="vehicle-suggestion-list" role="ocupantes" data="selected">
              <li><span class="icon-mini icon-clear"></span>2</li>
              <li><span class="icon-mini icon-clear"></span>3</li>
              <li><span class="icon-mini icon-clear"></span>4</li>
              <li role="selected"><span class="icon-mini icon-clear img-common icon-selected"></span>5</li>
              <li><span class="icon-mini icon-clear"></span>6</li>
              <li><span class="icon-mini icon-clear"></span>7</li>
              <li><span class="icon-mini icon-clear"></span>8</li>
              <li><span class="icon-mini icon-clear"></span>13</li>
              <li><span class="icon-mini icon-clear"></span>17</li>
              <li><input name="ocupantes" type="hidden" value="5"></li>
            </ul>
          </td>
          <td>
            <ul class="vehicle-suggestion-list" role="edad" data="selected">
              <li><span class="icon-mini icon-clear"></span>18</li>
              <li><span class="icon-mini icon-clear"></span>19</li>
              <li><span class="icon-mini icon-clear"></span>20</li>
              <li><span class="icon-mini icon-clear"></span>21</li>
              <li><span class="icon-mini icon-clear"></span>22</li>
              <li><span class="icon-mini icon-clear"></span>23</li>
              <li><span class="icon-mini icon-clear"></span>24</li>
              <li><span class="icon-mini icon-clear"></span>25</li>
              <li><span class="icon-mini icon-clear"></span>26</li>
              <li><span class="icon-mini icon-clear"></span>27</li>
              <li><span class="icon-mini icon-clear"></span>28</li>
              <li role="selected"><span class="icon-mini icon-clear img-common icon-selected"></span>29</li>
              <li><span class="icon-mini icon-clear"></span>30</li>
              <li><span class="icon-mini icon-clear"></span>31</li>
              <li><span class="icon-mini icon-clear"></span>32</li>
              <li><span class="icon-mini icon-clear"></span>33</li>
              <li><span class="icon-mini icon-clear"></span>34</li>
              <li><span class="icon-mini icon-clear"></span>35</li>
              <li><span class="icon-mini icon-clear"></span>36</li>
              <li><span class="icon-mini icon-clear"></span>37</li>
              <li><span class="icon-mini icon-clear"></span>38</li>
              <li><span class="icon-mini icon-clear"></span>39</li>
              <li><span class="icon-mini icon-clear"></span>40</li>
              <li><span class="icon-mini icon-clear"></span>41</li>
              <li><span class="icon-mini icon-clear"></span>42</li>
              <li><span class="icon-mini icon-clear"></span>43</li>
              <li><span class="icon-mini icon-clear"></span>44</li>
              <li><span class="icon-mini icon-clear"></span>45</li>
              <li><span class="icon-mini icon-clear"></span>46</li>
              <li><span class="icon-mini icon-clear"></span>47</li>
              <li><span class="icon-mini icon-clear"></span>48</li>
              <li><span class="icon-mini icon-clear"></span>49</li>
              <li><span class="icon-mini icon-clear"></span>50</li>
              <li><span class="icon-mini icon-clear"></span>51</li>
              <li><span class="icon-mini icon-clear"></span>52</li>
              <li><span class="icon-mini icon-clear"></span>53</li>
              <li><span class="icon-mini icon-clear"></span>54</li>
              <li><span class="icon-mini icon-clear"></span>55</li>
              <li><span class="icon-mini icon-clear"></span>56</li>
              <li><span class="icon-mini icon-clear"></span>57</li>
              <li><span class="icon-mini icon-clear"></span>58</li>
              <li><span class="icon-mini icon-clear"></span>59</li>
              <li><span class="icon-mini icon-clear"></span>60</li>
              <li><span class="icon-mini icon-clear"></span>61</li>
              <li><span class="icon-mini icon-clear"></span>62</li>
              <li><span class="icon-mini icon-clear"></span>63</li>
              <li><span class="icon-mini icon-clear"></span>64</li>
              <li><span class="icon-mini icon-clear"></span>65</li>
              <li><span class="icon-mini icon-clear"></span>66</li>
              <li><span class="icon-mini icon-clear"></span>67</li>
              <li><span class="icon-mini icon-clear"></span>68</li>
              <li><span class="icon-mini icon-clear"></span>69</li>
              <li><span class="icon-mini icon-clear"></span>70</li>
              <li><span class="icon-mini icon-clear"></span>71</li>
              <li><span class="icon-mini icon-clear"></span>72</li>
              <li><span class="icon-mini icon-clear"></span>73</li>
              <li><span class="icon-mini icon-clear"></span>74</li>
              <li><span class="icon-mini icon-clear"></span>75</li>
              <li><span class="icon-mini icon-clear"></span>76</li>
              <li><span class="icon-mini icon-clear"></span>77</li>
              <li><span class="icon-mini icon-clear"></span>78</li>
              <li><span class="icon-mini icon-clear"></span>79</li>
              <li><span class="icon-mini icon-clear"></span>80</li>
              <li><span class="icon-mini icon-clear"></span>81</li>
              <li><span class="icon-mini icon-clear"></span>82</li>
              <li><span class="icon-mini icon-clear"></span>83</li>
              <li><span class="icon-mini icon-clear"></span>84</li>
              <li><span class="icon-mini icon-clear"></span>85</li>
              <li><span class="icon-mini icon-clear"></span>86</li>
              <li><span class="icon-mini icon-clear"></span>87</li>
              <li><span class="icon-mini icon-clear"></span>88</li>
              <li><span class="icon-mini icon-clear"></span>89</li>
              <li><span class="icon-mini icon-clear"></span>90</li>
              <li><span class="icon-mini icon-clear"></span>91</li>
              <li><span class="icon-mini icon-clear"></span>92</li>
              <li><span class="icon-mini icon-clear"></span>93</li>
              <li><span class="icon-mini icon-clear"></span>94</li>
              <li><span class="icon-mini icon-clear"></span>95</li>
              <li><input name="edad" type="hidden" value="29"></li>
            </ul>
          </td>
          <td>
            <ul class="vehicle-suggestion-list" role="sexo" data="selected">
              <li role="selected"><span class="icon-mini icon-clear img-common icon-selected"></span>MASCULINO</li>
              <li><span class="icon-mini icon-clear"></span>FEMENINO</li>
              <li><input name="sexo" type="hidden" value="1"></li>
            </ul>
          </td>
          <td class="no-border">
            <ul class="vehicle-suggestion-list" role="civil" data="selected">
              <li><span class="icon-mini icon-clear"></span>CASADO</li>
              <li role="selected"><span class="icon-mini icon-clear img-common icon-selected"></span>SOLTERO</li>
              <li><input name="civil" type="hidden" value="1"></li>
            </ul>
          </td>
        </tr>
      </tbody>
    </table>
    <input type="hidden" name="id">
  </div>
  <div class="buttons-panel" style="text-align: left">
    <br>
    <span style="display: inline-block">
      <div class="required hide">Uno o varios campos son invälidos.</div>
    </span>
    <div class="pull-rigth">
      <input type="submit" class="common-button img-common" value="Enviar">
      <input type="button" class="common-button img-common" value="Cancelar" onclick="$('#vehicle').dialog('close');">
    </div>
  </div>
</form>