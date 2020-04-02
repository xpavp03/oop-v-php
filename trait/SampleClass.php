<?php

class SampleClass
{

  /*
   * @see https://www.php.net/manual/en/language.oop5.traits.php#language.oop5.traits.conflict
   */
  use SampleTrait {
    stejnyNazev as traitStejnyNazev;
  }


  public function vlastniMetoda(): void
  {
  }

  public function stejnyNazev(): string
  {
    return 'class' . $this->traitStejnyNazev();
  }

}